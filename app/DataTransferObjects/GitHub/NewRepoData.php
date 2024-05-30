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

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['description'],
            $data['is_private'],
        );
    }
}
