<?php

namespace App\Models;

use Illuminate\Support\Collection;

/** Get the movie instance */
readonly class ActorMovie
{
    /**
     * @param bool $adult
     * @param int $gender
     * @param int $id
     * @param string $known_for_department
     * @param string $name
     * @param string $original_name
     * @param float $popularity
     * @param ?string $profile_path
     * @param int $cast_id
     * @param string $character
     * @param string $credit_id
     * @param int $order
     */
    public function __construct(
        public bool    $adult,
        public int     $gender,
        public int     $id,
        public string  $known_for_department,
        public string  $name,
        public string  $original_name,
        public float   $popularity,
        public ?string $profile_path,
        public int     $cast_id,
        public string  $character,
        public string  $credit_id,
        public int     $order,
    )
    {
    }

    /**
     * @throws \JsonException
     */
    public static function createActorObject($response): ActorMovie|Collection
    {
        if (!is_array($response) && $response->count() > 1) {
            return $response->map(fn($movie) => self::mapObject($movie));
        }

        return self::mapObject($response);
    }

    public static function mapObject($object): self
    {
        return new self(
            $object['adult'],
            $object['gender'],
            $object['id'],
            $object['known_for_department'],
            $object['name'],
            $object['original_name'],
            $object['popularity'],
            $object['profile_path'],
            $object['cast_id'],
            $object['character'],
            $object['credit_id'],
            $object['order']
        );
    }
}
