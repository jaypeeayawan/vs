<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminCandidatesComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-candidates-component')
            ->layout('layouts.admin');
    }
}
