<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\NewRepoData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateRepo extends Request implements HasBody
{
    use HasJsonBody, ResponseMapper;

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
}
