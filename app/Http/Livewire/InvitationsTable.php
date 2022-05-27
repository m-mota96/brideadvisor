<?php

namespace App\Http\Livewire;

use App\Invitation;
use Livewire\Component;
use Livewire\WithPagination;


class InvitationsTable extends Component
{
    use WithPagination;

    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $invitations = Invitation::search(
            $this->search
        )->
        with('group')
        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->get();

        return view('livewire.invitations-table',[
            'invitations' => $invitations,
        ]);
    }
}
