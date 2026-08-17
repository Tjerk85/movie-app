<?php

namespace App\Models;

use Illuminate\Support\Collection;

readonly class Videos 
{
    /**
     * @throws \JsonException
     */
    public static function createVideoArray($response): array
    {
        if (!is_array($response) && $response->count() > 1 || $response instanceof Collection) {
            return $response->map(fn($video) => self::mapArray($video))->toArray();
        }

        return self::mapArray($response);
    }

    public static function mapArray($response): array
    {
        return [
            'name' => $response['name'], 
            'id' => $response['id'],
            'key' => $response['key'],
            'site' => $response['site'],
            'size' => $response['size'],
            'type' => $response['type'],
            'official' => $response['official'],
        ];
    }
}
