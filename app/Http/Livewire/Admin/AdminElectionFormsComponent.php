<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminElectionFormsComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-election-forms-component')
            ->layout('layouts.admin');
    }
}
