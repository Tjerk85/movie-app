<?php

namespace App\Models;

use Illuminate\Support\Collection;

/** Get the movie instance */
readonly class ActorSingle
{
    /**
     * @param bool $adult
     * @param array $also_known_as
     * @param string $biography
     * @param string|null $birthday
     * @param string|null $deathday
     * @param int $gender
     * @param string $homepage
     * @param int $id
     * @param string|null $imdb_id
     * @param string $known_for_department
     * @param string $name
     * @param string|null $place_of_birth
     * @param float $popularity
     * @param string|null $profile_path
     */
    public function __construct(
        public bool        $adult,
        public array       $also_known_as,
        public string      $biography,
        public string|null $birthday,
        public string|null $deathday,
        public int         $gender,
        public string|null $homepage,
        public int         $id,
        public string|null $imdb_id,
        public string      $known_for_department,
        public string      $name,
        public string|null $place_of_birth,
        public float       $popularity,
        public string|null $profile_path,
        public string      $profile_path_unknown,
        public array       $movie_credits,
        public array       $tv_credits,
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
            $object['birthday'],
            $object['deathday'],
            $object['gender'],
            $object['homepage'],
            $object['id'],
            $object['imdb_id'],
            $object['known_for_department'],
            $object['name'],
            $object['place_of_birth'],
            $object['popularity'],
            $object['profile_path'],
            $object['profile_path_unknown'] = 'images/Unknown_person.jpg',
            $object['movie_credits']['cast'],
            $object['tv_credits']['cast'],
        );
    }
}
