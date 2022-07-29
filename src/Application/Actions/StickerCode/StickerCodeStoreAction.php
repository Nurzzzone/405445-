<?php

namespace App\Application\Actions\StickerCode;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class StickerCodeStoreAction extends Action
{
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);
    }

    protected function action(): Response
    {
        dd($this->request->getBody()->getContents());

        $this->logger->info('New sticker code was stored');

        return $this->respondWithData(['message' => 'success']);
    }
}
