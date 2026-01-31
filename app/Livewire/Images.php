<?php

namespace App\Livewire;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Images\MovieImagesRequest;
use App\Services\MovieService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Images extends Component
{
    public string $posterPath;

    public int $imageSize;

    public array $images;

    public int $movieId;
    public string $movieTitle;

    public ?int $activeMovieId = null;

    public function render(): View
    {
        return view('livewire/images', [
            'posterPath' => $this->posterPath,
            'imageSize' => $this->imageSize,
            'movieId' => $this->movieId,
            'movieTitle' => $this->movieTitle
        ]);
    }

    public function openImages(int $movieId): void
    {
        $rqClass = MovieImagesRequest::class;
        $this->activeMovieId = $movieId;
        $this->images = (array) new MovieService()
            ->getSingleMedium(
                $movieId,
                $rqClass,
                EndPoints::$MOVIEIMAGESREQUEST
            );
    }

    public function mount(
        string $posterPath,
        int $imageSize,
        int $movieId,
        string $movieTitle
    ): void
    {
        $this->posterPath = $posterPath;
        $this->imageSize = $imageSize;
        $this->movieId = $movieId;
        $this->movieTitle = $movieTitle;
    }
}
