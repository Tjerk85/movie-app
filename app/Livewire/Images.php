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

    public int $mediaId;

    public string $title;

    public ?int $activeMediaId = null;

    public string $mediaType = 'movie';

    public function render(): View
    {
        return view('livewire/images', [
            'posterPath' => $this->posterPath,
            'imageSize' => $this->imageSize,
            'mediaId' => $this->mediaId,
            'title' => $this->title
        ]);
    }

    public function openImages(int $mediaId): void
    {
        $endPoint = EndPoints::$MOVIEIMAGESREQUEST;
        if ($this->mediaType !== 'movie') {
            $endPoint = EndPoints::$TVIMAGESREQUEST;
        }

        $rqClass = MovieImagesRequest::class;
        $this->activeMediaId = $mediaId;
        $this->images = (array) new MovieService()
            ->getSingleMedium(
                $mediaId,
                $rqClass,
                $endPoint
            );
    }

    public function mount(
        string $posterPath,
        int $imageSize,
        int $mediaId,
        string $title
    ): void
    {
        $this->posterPath = $posterPath;
        $this->imageSize = $imageSize;
        $this->mediaId = $mediaId;
        $this->title = $title;
    }
}
