<?php

namespace App\Livewire;

use App\Models\Invite;
use Livewire\Component;

class InviteIndex extends Component
{
    public $search;

    public $category;

    public function render()
    {
        return view('livewire.invite-index', [
            'invites' => Invite::latest()
                ->when($this->search)->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                })
                ->when($this->category)
                ->where('category', $this->category)
                ->get(),
        ]);
    }
}
