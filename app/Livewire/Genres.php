<?php

namespace App\Livewire;

use App\Services\GenreService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Genres extends Component
{
    public string $typeOfMedia;

    public function render(): View
    {
        return view('livewire.genres', [
                'genres' => (new GenreService())->getGenres($this->typeOfMedia),
            ]
        );
    }
}
