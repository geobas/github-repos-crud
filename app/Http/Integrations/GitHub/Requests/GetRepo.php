<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\Repo;
use Carbon\Carbon;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetRepo extends Request
{
    /**
     * The HTTP method of the request.
     */
    protected Method $method = Method::GET;

    /**
     * Create a new request instance.
     */
    public function __construct(
        private readonly string $owner,
        private readonly string $repo,
    ) {
    }

    /**
     * The endpoint for the request.
     */
    public function resolveEndpoint(): string
    {
        return '/repos/'.$this->owner.'/'.$this->repo;
    }

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
