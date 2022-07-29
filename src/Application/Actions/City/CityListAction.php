<?php

namespace App\Application\Actions\City;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class CityListAction extends Action
{
    protected function action(): Response
    {
        // should return id => name associative array
        return $this->respondWithData([]);
    }
}