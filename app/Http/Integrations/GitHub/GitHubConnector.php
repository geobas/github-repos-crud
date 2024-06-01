<?php

namespace App\Http\Integrations\GitHub;

use GuzzleHttp\Psr7\Header;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

class GitHubConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    /**
     * The Base URL of the API.
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.github.com/';
    }

    /**
     * Default headers for every request.
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/vnd.github+json',
        ];
    }

    /**
     * Default HTTP client options.
     */
    protected function defaultConfig(): array
    {
        return [];
    }

    /**
     * Paginate results.
     */
    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector : $this, request : $request) extends PagedPaginator
        {
            // protected ?int $perPageLimit = 10;

            protected function isLastPage(Response $response): bool
            {
                $linkHeader = Header::parse($response->header('Link'));

                return collect($linkHeader)
                    ->where(fn (array $link): bool => $link['rel'] === 'next')
                    ->isEmpty();
            }

            protected function getPageItems(
                Response $response,
                Request $request
            ): array {
                return $response->dtoOrFail()->toArray();
            }
        };
    }
}
