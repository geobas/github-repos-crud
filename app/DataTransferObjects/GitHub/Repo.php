<?php

namespace App\DataTransferObjects\GitHub;

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
}
