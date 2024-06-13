<?php

namespace App\Models;

use Illuminate\Support\Collection;
use App\Http\Integrations\themoviedb\TheMovieDbConnector;
use App\Http\Integrations\themoviedb\Requests\GenresRequest;

class Movie
{
    public function __construct(
        public readonly int              $id,
        public readonly string           $title,
        public readonly string           $overview,
        public readonly string|null      $poster_path,
        public readonly float            $vote_average,
        public readonly string           $release_date,
        public readonly Collection|array $genre_ids,
        public readonly string|null      $backdrop_path,
        public readonly string           $original_title,
        public readonly string           $original_language,
        public readonly float            $popularity,
        public readonly int              $vote_count,
        public readonly bool             $video,
        public readonly bool             $adult,
    )
    {
    }

    public function getMoviePoster()
    {
        return new self(
            id: $this->id,
            title: $this->title,
            overview: $this->overview,
            poster_path: $this->poster_path,
            vote_average: $this->vote_average,
            genre_ids: $this->getGenreByIds(),
            release_date: $this->release_date,
            backdrop_path: $this->backdrop_path,
            original_title: $this->original_title,
            original_language: $this->original_language,
            popularity: $this->popularity,
            vote_count: $this->vote_count,
            video: $this->video,
            adult: $this->adult
        );
    }

    private function getGenreByIds(): Collection
    {
        $connector = new TheMovieDbConnector();

        /** @var \Illuminate\Support\Collection $genres */
        $genres = $connector->send(new GenresRequest())->dto();

        $result = $genres->whereIn('id', $this->genre_ids);

        // If result already contains the Genres instead of the ids
        if ($result->isEmpty()) {
            foreach ($this->genre_ids as $genre) {
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
