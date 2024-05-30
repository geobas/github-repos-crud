<?php

namespace App\Services\GitHub;

use App\Collections\GitHub\RepoCollection;
use App\Contracts\GitHub;
use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\Repo;
use App\DataTransferObjects\GitHub\UpdateRepoData;
use App\Http\Integrations\GitHub\GitHubConnector;
use App\Http\Integrations\GitHub\Requests\CreateRepo;
use App\Http\Integrations\GitHub\Requests\DeleteRepo;
use App\Http\Integrations\GitHub\Requests\GetRepo;
use App\Http\Integrations\GitHub\Requests\GetRepoLanguages;
use App\Http\Integrations\GitHub\Requests\UpdateRepo;

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
     * Get a list of programming languages used in a repository.
     */
    public function getRepoLanguages(string $owner, string $repoName): array
    {
        return $this->connector()
            ->send(new GetRepoLanguages($owner, $repoName))
            ->collect()
            ->keys()
            ->all();
    }

    /**
     * Create a repository.
     */
    public function createRepo(NewRepoData $repoData): Repo
    {
        return $this->connector()
            ->send(new CreateRepo($repoData))
            ->dtoOrFail();
    }

    /**
     * Update a repository.
     */
    public function updateRepo(string $owner, string $repoName, UpdateRepoData $repoData): Repo
    {
        return $this->connector()
            ->send(new UpdateRepo($owner, $repoName, $repoData))
            ->dtoOrFail();
    }

    /**
     * Delete a repository.
     */
    public function deleteRepo(string $owner, string $repoName): void
    {
        $this->connector()
            ->send(new DeleteRepo($owner, $repoName));
    }
}
