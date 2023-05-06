<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminVotersComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-voters-component')
            ->layout('layouts.admin');
    }
}
