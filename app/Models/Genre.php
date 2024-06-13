<?php

namespace App\Models;

class Genre
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    )
    {
    }
}
