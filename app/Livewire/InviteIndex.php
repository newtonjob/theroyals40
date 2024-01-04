<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateInviteForm;
use App\Models\Invite;
use Livewire\Component;

class InviteIndex extends Component
{
    public $search;

    public $category;

    public UpdateInviteForm $form;

    public function edit(Invite $invite): void
    {
        $this->form->edit($invite);
    }

    public function update(): void
    {
        $this->form->update();

        $this->dispatch('invite-updated');
    }

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
