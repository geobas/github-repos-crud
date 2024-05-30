<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\Repo;
use Carbon\Carbon;
use Saloon\Http\Response;

trait ResponseMapper
{
    /**
     * Map the response	body to a DTO.
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        $responseData = $response->json();

        return new Repo(
            id : $responseData['id'],
            owner : $responseData['owner']['login'],
            name : $responseData['name'],
            fullName : $responseData['full_name'],
            private : $responseData['private'],
            description : $responseData['description'] ?? '',
            createdAt : Carbon::parse($responseData['created_at']),
        );
    }
}
