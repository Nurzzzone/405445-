<?php

namespace App\Application\Actions\City;

use App\Application\Actions\Action;
use App\Domain\City\CityRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CityListAction extends Action
{
    private CityRepository $repository;

    public function __construct(LoggerInterface $logger, CityRepository $repository)
    {
        parent::__construct($logger);

        $this->repository = $repository;
    }

    protected function action(): Response
    {
        $this->logger->info('City list was viewed');

        return $this->respondWithData($this->repository->findAll());
    }
}
