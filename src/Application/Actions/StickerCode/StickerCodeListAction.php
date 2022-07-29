<?php

namespace App\Application\Actions\StickerCode;

use App\Application\Actions\Action;
use App\Domain\StickerCode\StickerCodeRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class StickerCodeListAction extends Action
{
    private StickerCodeRepository $repository;

    public function __construct(LoggerInterface $logger, StickerCodeRepository $repository)
    {
        parent::__construct($logger);

        $this->repository = $repository;
    }

    protected function action(): Response
    {
        return $this->respondWithData($this->repository->findAll());
    }
}
