<?php

namespace App\Http\Integrations\themoviedb\Requests;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class PopularMoviesRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/movie/popular?language=en-US&page=1';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json('results');

        return collect($data)->map(fn ($movie) => new Movie(
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
        ));
    }
}
