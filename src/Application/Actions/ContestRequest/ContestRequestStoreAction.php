<?php

namespace App\Application\Actions\ContestRequest;

use App\Application\Actions\Action;
use App\Domain\ContestRequest\ContestRequestRepository;
use App\Domain\StickerCode\StickerCodeRepository;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ContestRequestStoreAction extends Action
{
    /**
     * @var StickerCodeRepository
     */
    protected $stickerCodeRepository;

    /**
     * @var ContestRequestRepository
     */
    protected $contestRequestRepository;

    /**
     * @var string[]
     */
    protected static $requestParams = [
        'first_name',
        'sticker_code',
        'city_id',
        'phone_number',
    ];

    public function __construct(
        LoggerInterface $logger,
        StickerCodeRepository $stickerCodeRepository,
        ContestRequestRepository $contestRequestRepository
    ) {
        parent::__construct($logger);

        $this->stickerCodeRepository = $stickerCodeRepository;
        $this->contestRequestRepository = $contestRequestRepository;
    }

    public function action(): Response
    {
        $requestBody = $this->request->getParsedBody();

        foreach (static::$requestParams as $paramName) {
            if (! array_key_exists($paramName, $requestBody)) {
                throw new HttpBadRequestException($this->request, 'Request body missing required parameters.');
            }
        }

        if (! $this->stickerCodeRepository->isValidStickerCode($requestBody['sticker_code'])) {
            throw new HttpBadRequestException($this->request, 'Invalid sticker code provided.');
        }

        $currentRequestCount = $this->contestRequestRepository->getCurrentWeekCountFor($requestBody['phone_number']);

        if ($currentRequestCount === $this->contestRequestRepository::STICKER_CODE_PER_PHONE_NUMBER) {
            throw new HttpBadRequestException($this->request, 'Count limit exceeds the allowable value.');
        }

        $isAlreadyRegistered = $this->contestRequestRepository
            ->isAlreadyRegistered($requestBody['phone_number'], $requestBody['sticker_code']);

        if ($isAlreadyRegistered) {
            throw new HttpBadRequestException($this->request, 'Sticker code is already registered');
        }

        $this->contestRequestRepository->insertContestRequest($requestBody);

        $this->logger->info(
            sprintf(
                '%s registered new sticker code %s',
                $requestBody['phone_number'],
                $requestBody['sticker_code']
            )
        );

        return $this->respondWithData(['message' => 'success']);
    }
}
