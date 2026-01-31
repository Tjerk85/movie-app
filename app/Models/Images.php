<?php

namespace App\Models;

readonly class Images
{
    public function __construct(
        public array $backdrops,
        public int $id,
        public array $logos,
        public array $posters,
    )
    {}

    public static function createMovieObject($response): Images
    {
        return new self(
            $response['backdrops'],
            $response['id'],
            $response['logos'],
            $response['posters'],
        );
    }
}
