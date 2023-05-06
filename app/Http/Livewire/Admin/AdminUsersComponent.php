<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminUsersComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-users-component')
            ->layout('layouts.admin');
    }
}
