<?php

namespace App\Models;

use Illuminate\Support\Collection;

readonly class SearchMulti
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $poster_path,
        public string $media_type,
        public string $medium,
    )
    {}

    public static function createSearchObject($response): Collection|null
    {
        if (! $response->count() >= 1) {
            return null;
        }

        return $response->map(fn ($object) => self::mapObject($object));
    }

    public static function mapObject($object): self
    {
        return new self(
            $object['id'],
            $object['title'] ?? $object['name'],
            $object['poster_path'] ?? null ?? $object['profile_path'] ?? null,
            $object['media_type'],
            self::getMediumUrl($object),
        );
    }

    private static function getMediumUrl(array $object): string
    {
        switch ($object['media_type']) {
            case 'person':
                return "/actors/actor/{$object['id']}";
            case 'tv':
                return "/tv/show/{$object['id']}";
            default:
                return "/show/{$object['id']}";
        }
    }
}
