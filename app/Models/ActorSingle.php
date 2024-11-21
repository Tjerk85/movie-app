<?php

namespace App\Models;

use Illuminate\Support\Collection;

/** Get the movie instance */
readonly class ActorSingle
{
    /**
     * @param  bool    $adult
     * @param  array   $also_known_as
     * @param  string  $biography
     * @param  ?string $birthday
     * @param  ?string $deathday
     * @param  int     $gender
     * @param  ?string $homepage
     * @param  int     $id
     * @param  ?string $imdb_id
     * @param ?string  $known_for_department
     * @param  string  $name
     * @param  ?string $place_of_birth
     * @param  float   $popularity
     * @param  ?string $profile_path
     * @param  ?string $profile_path_unknown
     * @param  ?array  $movie_credits
     * @param  ?array  $tv_credits
     */
    public function __construct(
        public bool    $adult,
        public array   $also_known_as,
        public string  $biography,
        public ?string $birthday,
        public ?string $deathday,
        public int     $gender,
        public ?string $homepage,
        public int     $id,
        public ?string $imdb_id,
        public ?string $known_for_department,
        public string  $name,
        public ?string $place_of_birth,
        public float   $popularity,
        public ?string $profile_path,
        public ?string $profile_path_unknown,
        public ?array  $movie_credits,
        public ?array  $tv_credits,
    )
    {
    }

    /**
     * @throws \JsonException
     */
    public static function createActorObject($response): ActorSingle|Collection
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
            $object['also_known_as'],
            $object['biography'],
            $object['birthday'] ?? null,
            $object['deathday'] ?? null,
            $object['gender'],
            $object['homepage'] ?? null,
            $object['id'],
            $object['imdb_id'] ?? null,
            $object['known_for_department'] ?? null,
            $object['name'],
            $object['place_of_birth'] ?? null,
            $object['popularity'],
            $object['profile_path'] ?? null,
            $object['profile_path_unknown'] = 'images/Unknown_person.jpg',
            $object['movie_credits']['cast'] ?? null,
            $object['tv_credits']['cast'] ?? null,
        );
    }
}
