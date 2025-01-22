<?php

namespace App\Livewire;

use App\Services\SearchMultiService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchMulti extends Component
{
    #[Url]
    public $search;

    public function render(): View
    {
        $searchResults = [];
        if (strlen($this->search) >= 2) {
            $searchResults = (new SearchMultiService($this->search))->searchQuery();
        }

        return view('livewire.search-multi', [
            'results' => $searchResults,
        ]);
    }
}
