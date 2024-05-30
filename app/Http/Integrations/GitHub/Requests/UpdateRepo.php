<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\UpdateRepoData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateRepo extends Request implements HasBody
{
    use HasJsonBody, ResponseMapper;

    /**
     * The HTTP method of the request.
     */
    protected Method $method = Method::PATCH;

    /**
     * Create a new request instance.
     */
    public function __construct(
        private readonly string $owner,
        private readonly string $repoName,
        private readonly UpdateRepoData $updateRepoData,
    ) {
    }

    /**
     * The endpoint for the request.
     */
    public function resolveEndpoint(): string
    {
        return '/repos/'.$this->owner.'/'.$this->repoName;
    }

    /**
     * Set the request body on the fly.
     */
    protected function defaultBody(): array
    {
        return [
            'name' => $this->updateRepoData->name,
            'description' => $this->updateRepoData->description,
            'private' => $this->updateRepoData->isPrivate,
        ];
    }
}
