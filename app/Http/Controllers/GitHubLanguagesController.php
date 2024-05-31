<?php

namespace App\Http\Controllers;

use App\Contracts\GitHub;
use App\Http\Resources\GitHubRepoLanguagesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GitHubLanguagesController extends Controller
{
    /**
     * Fetch a list of programming languages.
     */
    public function __invoke(string $owner, string $repoName, GitHub $gitHub): JsonResource
    {
        return GitHubRepoLanguagesResource::make(
            $gitHub->getRepoLanguages(
                owner : $owner,
                repoName : $repoName,
            )
        );
    }
}
