<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GitHubRepoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'owner' => $this->owner,
            'name' => $this->name,
            'fullName' => $this->fullName,
            'private' => $this->private,
            'description' => $this->description,
            'createdAt' => $this->createdAt->format('d-m-Y H:i:s'),
        ];
    }
}
