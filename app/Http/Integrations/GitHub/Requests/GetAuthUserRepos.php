<?php

namespace App\Http\Integrations\GitHub\Requests;

use App\DataTransferObjects\GitHub\Repo;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetAuthUserRepos extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/user/repos';
    }

    /**
     * Map the response	body to a DTO.
     *
     * @return Collection<Repo>
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->collect()
            ->map(fn (array $repo): Repo => Repo::fromArray($repo));
    }
}
