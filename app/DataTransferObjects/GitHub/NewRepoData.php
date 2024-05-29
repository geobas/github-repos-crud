<?php

namespace App\DataTransferObjects\GitHub;

final readonly class NewRepoData
{
    public function __construct(
        public string $name,
        public string $description,
        public bool $isPrivate,
    ) {
    }
}
