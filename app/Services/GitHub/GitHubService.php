<?php

namespace App\Services\GitHub;

use App\Collections\GitHub\RepoCollection;
use App\Contracts\GitHub;
use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\Repo;
use App\DataTransferObjects\GitHub\UpdateRepoData;
use App\Http\Integrations\GitHub\GitHubConnector;
use App\Http\Integrations\GitHub\Requests\GetRepo;

class GitHubService implements GitHub
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        private string $token,
    ) {
    }

    /**
     * Resolve a new connector instance.
     */
    private function connector(): GitHubConnector
    {
        return resolve(GitHubConnector::class)->withTokenAuth(
            token : $this->token,
        );
    }

    /**
     * Get all repositories.
     */
    public function getRepos(): RepoCollection
    {
    }

    /**
     * Get a repository.
     */
    public function getRepo(string $owner, string $repoName): Repo
    {
        return $this->connector()
            ->send(new GetRepo($owner, $repoName))
            ->dtoOrFail();
    }

    /**
     * Get repository's programming languages.
     */
    public function getRepoLanguages(string $owner, string $repoName): array
    {
    }

    /**
     * Create a repository.
     */
    public function createRepo(NewRepoData $repoData): Repo
    {
    }

    /**
     * Update a repository.
     */
    public function updateRepo(string $owner, string $repoName, UpdateRepoData $repoData): Repo
    {
    }

    /**
     * Delete a repository.
     */
    public function deleteRepo(string $owner, string $repoName): void
    {
    }
}
