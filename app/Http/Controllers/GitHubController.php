<?php

namespace App\Http\Controllers;

use App\Contracts\GitHub;
use App\Http\Resources\GitHubRepoLanguagesResource;
use App\Http\Resources\GitHubRepoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GitHubController extends Controller
{
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
