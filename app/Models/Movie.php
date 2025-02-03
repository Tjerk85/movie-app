<?php

namespace App\Models;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\GenresRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

/** Get the movie instance */
readonly class Movie
{
    public function __construct(
        public int $id,
        public string $title,
        public string $overview,
        public ?string $poster_path,
        public ?string $poster_unknown,
        public float $vote_average,
        public string $release_date,
        public Collection|array $genre_ids,
        public ?string $backdrop_path,
        public string $original_title,
        public string $original_language,
        public float $popularity,
        public int $vote_count,
        public bool $video,
        public bool $adult,
    ) {}

    /**
     * @return Collection
     *
     * @throws \JsonException
     */
    public static function createMovieObject($response): Movie|Collection
    {
        if (! is_array($response) && $response->count() > 1 || $response instanceof Collection) {
            return $response->map(fn ($movie) => self::mapObject($movie));
        }

        return self::mapObject($response);
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public static function mapObject($object): self
    {
        return new self(
            $object['id'],
            $object['title'],
            $object['overview'],
            $object['poster_path'],
            $object['poster_unknown'] = 'images/Unknown_movie.png',
            $object['vote_average'],
            $object['release_date'],
            isset($object['genre_ids'])
                ? self::getGenreByIds($object['genre_ids'])
                : self::getGenreByIds($object['genres']),
            $object['backdrop_path'] ?? null,
            $object['original_title'],
            $object['original_language'],
            $object['popularity'],
            $object['vote_count'],
            $object['video'],
            $object['adult']
        );
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    private static function getGenreByIds($genresObject): Collection
    {
        $connector = new TheMovieDbConnector();
        $endPoint = new EndPoints();

        /** @var Collection $genres */
        $genres = $connector->send(new GenresRequest(
            $endPoint
                ->set($endPoint::$MOVIEGENREREREQUEST)
                ->getEndPoint()
        ))->dto();

        $result = $genres->whereIn('id', $genresObject);

        // If result already contains the Genres instead of the ids
        $results = [];
        if ($result->isEmpty()) {
            foreach ($genresObject as $genre) {
                $results[] = new Genre(
                    id: $genre['id'],
                    name: $genre['name'],
                );
            }

            return collect($results);
        }

        return $result;
    }
}
