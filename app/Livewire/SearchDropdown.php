<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];
        $apiKey = '68fec7b5ce41029ca9f94239ce5bab09';

        if (strlen($this->search) >= 2) {
            $searchUrl = 'https://api.themoviedb.org/3/search/movie?query=' . $this->search . '&api_key=' . $apiKey;
            $searchResults = Http::get($searchUrl)->json()['results'];
        }
        
        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }

    public function performSearch()
    {
        $this->search;
    }

    public function showResultsOnEnter()
    {
        $this->performSearch();
    }

}
