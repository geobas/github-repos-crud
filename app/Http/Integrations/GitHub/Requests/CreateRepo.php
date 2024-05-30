<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\Repo;
use Carbon\Carbon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateRepo extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    /**
     * Create a new request instance.
     */
    public function __construct(
        private readonly NewRepoData $newRepoData,
    ) {
    }

    /**
     * The endpoint for the request.
     */
    public function resolveEndpoint(): string
    {
        return '/user/repos';
    }

    /**
     * Set the request body on the fly.
     */
    protected function defaultBody(): array
    {
        return [
            'name' => $this->newRepoData->name,
            'description' => $this->newRepoData->description,
            'private' => $this->newRepoData->isPrivate,
        ];
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
