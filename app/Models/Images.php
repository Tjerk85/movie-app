<?php

namespace App\Models;

use Illuminate\Support\Collection;

readonly class Images
{
    public function __construct(
        public ?array $backdrops,
        public ?string $file_path,
        public ?int $id,
        public ?array $logos,
        public ?array $posters,
    )
    {}

    public static function createImageObject($response): Images|Collection|array
    {
        if (! is_array($response) && $response->count() > 1 || $response instanceof Collection) {
            return $response->map(fn ($image) => self::mapObject($image))->toArray();
        }

        return self::mapObject($response);
    }
    

    public static function mapObject($response): Images|array
    {
        return [
            'backdrops' => $response['backdrops'] ?? null,
            'file_path' => $response['file_path'] ?? null,
            'id' => $response['id'] ?? null,
            'logos' => $response['logos'] ?? null,
            'posters' => $response['posters'] ?? null,
        ];
    }
}
