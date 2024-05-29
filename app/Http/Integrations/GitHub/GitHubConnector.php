<?php

namespace App\Http\Integrations\GitHub;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class GitHubConnector extends Connector
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
}
