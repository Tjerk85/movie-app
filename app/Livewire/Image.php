<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Image extends Component
{
    public string $imageUrl;

    public string $movieTitle;

    public function render(): View
    {
        return view('livewire.image', [
                'imageUrl' => $this->imageUrl,
                'movieTitle' => $this->movieTitle
            ]
        );
    }
}
