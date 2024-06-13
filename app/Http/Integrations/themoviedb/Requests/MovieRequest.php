<?php

namespace App\Http\Integrations\themoviedb\Requests;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class MovieRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(protected readonly int $movieId)
    {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/movie/{$this->movieId}";
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new Movie(
            id: $data['id'],
            title: $data['title'],
            overview: $data['overview'],
            poster_path: $data['poster_path'],
            vote_average: $data['vote_average'],
            release_date: $data['release_date'],
            genre_ids: $data['genres'],
            backdrop_path: $data['backdrop_path'],
            original_title: $data['original_title'],
            original_language: $data['original_language'],
            popularity: $data['popularity'],
            vote_count: $data['vote_count'],
            video: $data['video'],
            adult: $data['adult'],
        );
    }
}
