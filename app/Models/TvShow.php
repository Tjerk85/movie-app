<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Exceptions\Request\FatalRequestException;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\TvShows\TvGenresRequest;

/** Get the tv instance */
readonly class TvShow
{
    /**
     * @param bool             $adult
     * @param string|null      $backdrop_path
     * @param Collection|array $genre_ids
     * @param int              $id
     * @param array            $origin_country
     * @param string           $original_language
     * @param string           $original_name
     * @param string           $overview
     * @param float            $popularity
     * @param string|null      $poster_path
     * @param string           $first_air_date
     * @param string           $name
     * @param float            $vote_average
     * @param int              $vote_count
     */
    public function __construct(
        public bool             $adult,
        public string|null      $backdrop_path,
        public Collection|array $genre_ids,
        public int              $id,
        public array            $origin_country,
        public string           $original_language,
        public string           $original_name,
        public string           $overview,
        public float            $popularity,
        public string|null      $poster_path,
        public string           $first_air_date,
        public string           $name,
        public float            $vote_average,
        public int              $vote_count,
    )
    {
    }

    /**
     * @param $response
     * @return Collection
     * @throws \JsonException
     */
    static public function createTvShowObject($response): TvShow|Collection
    {
        if (! is_array($response) && $response->count() > 1) {
            return $response->map(fn ($tv) => self::mapObject($tv));
        }

        return self::mapObject($response);
    }

    /**
     * @param $object
     * @return Movie
     * @throws FatalRequestException
     * @throws RequestException
     */
    static public function mapObject($object): self
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
    static private function getGenreByIds($genresObject): Collection
    {
        $connector = new TheMovieDbConnector();

        /** @var Collection $genres */
        $genres = $connector->send(new TvGenresRequest())->dto();

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
