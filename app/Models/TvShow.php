<?php

namespace App\Models;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\GenresRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

/** Get the tv instance */
readonly class TvShow
{
    public function __construct(
        public bool $adult,
        public ?string $backdrop_path,
        public Collection|array $genre_ids,
        public int $id,
        public array $origin_country,
        public string $original_language,
        public string $original_name,
        public string $overview,
        public float $popularity,
        public ?string $poster_path,
        public string $first_air_date,
        public string $name,
        public float $vote_average,
        public int $vote_count,
    ) {}

    /**
     * @return TvShow
     *
     * @throws \JsonException
     */
    public static function createTvShowObject($response): TvShow|Collection
    {
        if (! is_array($response) && $response->count() > 1 || $response instanceof Collection) {
            return $response->map(fn ($tv) => self::mapObject($tv));
        }

        return self::mapObject($response);
    }

    /**
     * @return TvShow
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public static function mapObject($object): TvShow|array
    {
        return new self(
            $object['adult'],
            $object['backdrop_path'],
            isset($object['genre_ids'])
                ? self::getGenreByIds($object['genre_ids'])
                : self::getGenreByIds($object['genres']),
            $object['id'],
            $object['origin_country'],
            $object['original_language'],
            $object['original_name'],
            $object['overview'],
            $object['popularity'],
            $object['poster_path'],
            $object['first_air_date'],
            $object['name'],
            $object['vote_average'],
            $object['vote_count'],
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
                ->set($endPoint::$TVSHOWGENREREQUEST)
                ->getEndPoint()
        ))
            ->dto();

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
