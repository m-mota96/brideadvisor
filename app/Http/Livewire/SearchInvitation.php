<?php

namespace App\Http\Livewire;

use App\Invitation;
use Livewire\Component;

class SearchInvitation extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-invitation',[
            'invitations' => Invitation::search(
                $this->search
            )->get(),
        ]);
    }
}
