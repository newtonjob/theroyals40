<?php

namespace App\Livewire\Forms;

use App\Models\Invite;
use Livewire\Form;

class UpdateInviteForm extends Form
{
    public Invite $invite;

    public $name;

    public $email;

    public $category;

    public $passes;

    public function edit(Invite $invite)
    {
        $this->invite = $invite;

        $this->fill($invite->only('name', 'email', 'category', 'passes'));
    }

    public function update(): void
    {
        $this->invite->update($this->except('invite'));
    }
}
