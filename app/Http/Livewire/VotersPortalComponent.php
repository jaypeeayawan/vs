<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VotersPortalComponent extends Component
{
    public function render()
    {
        $pageTitle = 'Voters Portal';
        return view('livewire.voters-portal-component',
            [
                'pageTitle' => $pageTitle,
            ]
        )
        ->layout('layouts.base');
    }
}
