<?php

namespace App\DataTransferObjects\GitHub;

final readonly class UpdateRepoData
{
    public function __construct(
        public string $name,
        public string $description,
        public bool $isPrivate,
    ) {
    }
}
