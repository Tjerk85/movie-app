<?php

namespace App\Http\Integrations\themoviedb\Requests;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class TrendingMoviesRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * $when parameter can be {day} or {week}
     */
    public function __construct(protected readonly string $when)
    {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/trending/movie/{$this->when}?language=en-US";
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $movies = [];
        $data   = $response->json('results');

        foreach ($data as $movie) {
            $movies[] = new Movie(
                id: $movie['id'],
                title: $movie['title'],
                overview: $movie['overview'],
                poster_path: $movie['poster_path'],
                vote_average: $movie['vote_average'],
                release_date: $movie['release_date'],
                genre_ids: $movie['genre_ids'],
                backdrop_path: $movie['backdrop_path'],
                original_title: $movie['original_title'],
                original_language: $movie['original_language'],
                popularity: $movie['popularity'],
                vote_count: $movie['vote_count'],
                video: $movie['video'],
                adult: $movie['adult'],
            );
        }

        return collect($movies);
    }
}
