<?php

namespace App\Http\Controllers;

use App\Contracts\GitHub;
use App\DataTransferObjects\GitHub\NewRepoData;
use App\DataTransferObjects\GitHub\UpdateRepoData;
use App\Http\Requests\RepositoryCreateRequest;
use App\Http\Requests\RepositoryUpdateRequest;
use App\Http\Resources\GitHubRepoLanguagesResource;
use App\Http\Resources\GitHubRepoResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class GitHubController extends Controller
{
    /**
     * Create a repository.
     */
    public function create(RepositoryCreateRequest $request, GitHub $gitHub): JsonResource
    {
        return GitHubRepoResource::make(
            $gitHub->createRepo(
                repoData : NewRepoData::fromArray($request->validated())
            )
        );
    }

    /**
     * Fetch a single repository.
     */
    public function show(string $owner, string $name, GitHub $gitHub): JsonResource
    {
        return GitHubRepoResource::make(
            $gitHub->getRepo(
                owner : $owner,
                repoName : $name,
            )
        );
    }

    /**
     * Update a repository.
     */
    public function update(RepositoryUpdateRequest $request, GitHub $gitHub): JsonResource
    {
        $validated = $request->validated();

        return GitHubRepoResource::make(
            $gitHub->updateRepo(
                owner : Arr::pull($validated, 'owner'),
                repoName : Arr::pull($validated, 'old_name'),
                repoData : UpdateRepoData::fromArray($validated)
            )
        );
    }

    /**
     * Fetch a list of programming languages.
     */
    public function languages(string $owner, string $repoName, GitHub $gitHub): JsonResource
    {
        return GitHubRepoLanguagesResource::make(
            $gitHub->getRepoLanguages(
                owner : $owner,
                repoName : $repoName,
            )
        );
    }
}
