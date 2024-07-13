<?php

namespace App\Models;

readonly class Genre
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}
}
