<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\RequestException;
use App\Http\Integrations\TheMovieDb\EndPoints;
use Saloon\Exceptions\Request\FatalRequestException;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\GenresRequest;

/** Get the movie instance */
readonly class Movie
{
    /**
     * @param int              $id
     * @param string           $title
     * @param string           $overview
     * @param string|null      $poster_path
     * @param float            $vote_average
     * @param string           $release_date
     * @param Collection|array $genre_ids
     * @param string|null      $backdrop_path
     * @param string           $original_title
     * @param string           $original_language
     * @param float            $popularity
     * @param int              $vote_count
     * @param bool             $video
     * @param bool             $adult
     */
    public function __construct(
        public int              $id,
        public string           $title,
        public string           $overview,
        public string|null      $poster_path,
        public float            $vote_average,
        public string           $release_date,
        public Collection|array $genre_ids,
        public string|null      $backdrop_path,
        public string           $original_title,
        public string           $original_language,
        public float            $popularity,
        public int              $vote_count,
        public bool             $video,
        public bool             $adult,
    )
    {
    }

    /**
     * @param $response
     * @return Collection
     * @throws \JsonException
     */
    static public function createMovieObject($response): Movie|Collection
    {
        if (! is_array($response) && $response->count() > 1) {
            return $response->map(fn ($movie) => self::mapObject($movie));
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
            $object['id'],
            $object['title'],
            $object['overview'],
            $object['poster_path'],
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
    static private function getGenreByIds($genresObject): Collection
    {
        $connector = new TheMovieDbConnector();
        $endPoint  = new EndPoints();

        /** @var Collection $genres */
        $genres = $connector->send(new GenresRequest(
            $endPoint
                ->set($endPoint::$MOVIEGENREREREQUEST)
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
