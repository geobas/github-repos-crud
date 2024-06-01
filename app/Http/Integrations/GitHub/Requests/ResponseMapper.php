<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\Repo;
use Saloon\Http\Response;

trait ResponseMapper
{
    /**
     * Map the response	body to a DTO.
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return Repo::fromArray($response->json());
    }
}
