<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $pageTitle = 'Home Page';
        return view('livewire.home-component',
            [
                'pageTitle' => $pageTitle,
            ]
        )
        ->layout('layouts.base');
    }
}
