<?php

namespace App\Contracts;

use App\Collections\GitHub\RepoCollection;
use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\Repo;
use App\DataTransferObjects\GitHub\UpdateRepoData;

interface GitHub
{
    /**
     * Fetch all repositories.
     */
    public function getRepos(): RepoCollection;

    /**
     * Fetch a single repository.
     */
    public function getRepo(string $owner, string $repoName): Repo;

    /**
     * Get programming languages of a specific repository.
     */
    public function getRepoLanguages(string $owner, string $repoName): array;

    /**
     * Create a new repository.
     */
    public function createRepo(NewRepoData $repoData): Repo;

    /**
     * Update a repository.
     */
    public function updateRepo(string $owner, string $repoName, UpdateRepoData $repoData): Repo;

    /**
     * Delete a repository.
     */
    public function deleteRepo(string $owner, string $repoName): void;
}
