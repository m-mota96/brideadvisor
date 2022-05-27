<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = 'Anna';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = \App\Group::search(
                $this->search
            )->get()
                ;
        }

        return view('livewire.search-dropdown',[
            'searchResults' => $searchResults
        ]);
    }
}
