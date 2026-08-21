<?php

namespace App\Livewire;

use App\Http\Integrations\TheMovieDb\Requests\Videos\TvShowVideosRequest;
use Livewire\Component;
use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Services\MovieService;

class Trailers extends Component
{
    public array $videos;

    public string $mediaType;

    public int $mediaId;

    public function render()
    {
        return view('livewire/trailers');
    }

    public function openVideos(int $mediaId): void 
    {
        $endPoint = EndPoints::$MOVIEVIDEOSREQUEST;
        if ($this->mediaType !== 'movie') {
            $endPoint = EndPoints::$TVVIDEOSREQUEST;
        }

        $results = new MovieService()
            ->getSingleMedium(
                $mediaId,
                TvShowVideosRequest::class,
                $endPoint,
                'results'
            );

        $videoTrailers = array_filter(
            $results,
            fn ($value) => $value['type'] === 'Trailer'
        );

        $videoTeaser = array_filter(
            $results,
            fn ($value) => $value['type'] === 'Teaser'
        );

        $this->videos = array_merge(
            $videoTrailers,
            array_slice($videoTeaser, 0, 18)
        );
    }
};
