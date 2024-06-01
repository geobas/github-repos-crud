<?php

namespace App\DataTransferObjects\GitHub;

use Carbon\Carbon;
use Carbon\CarbonInterface;

final readonly class Repo
{
    public function __construct(
        public int $id,
        public string $owner,
        public string $name,
        public string $fullName,
        public bool $private,
        public string $description,
        public CarbonInterface $createdAt,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id : $data['id'],
            owner : $data['owner']['login'],
            name : $data['name'],
            fullName : $data['full_name'],
            private : $data['private'],
            description : $data['description'] ?? '',
            createdAt : Carbon::parse($data['created_at']),
        );
    }
}
