<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Voters;

class VotersPortalComponent extends Component
{
    public $votersid;
    public $votersnumber;

    protected $messages = [
        'votersnumber.required' => 'Voters number cannot be empty',
        'votersnumber.unique' => 'Description already exist',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'votersnumber' => 'required',
        ]);
    }

    public function auth()
    {
        $this->validate([
            'votersnumber' => 'required',
        ]);

        try{
            if (Voters::where('votersnumber', $this->votersnumber)->exists()) {
                
                $voter = Voters::where('votersnumber', $this->votersnumber)
                    ->first();
                $this->votersid = $voter->id;

                return redirect()->route('voting.form', $this->votersid);

            }else {
                $this->dispatchBrowserEvent('alert',[
                    'type' => 'error',
                    'message' => 'Could not find voters\' number '.$this->votersnumber.'. Please contact your system adminstrator.',
                ]);
            }

            // Set Flash Message
            // $this->dispatchBrowserEvent('alert',[
            //     'type' => 'success',
            //     'message' => "Position has been created successfully!"
            // ]);

            // $this->resetInputFields();
            // $this->emit('postStored');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while creating department!"
            ]);

            // $this->resetInputFields();
            // $this->emit('postStored');
        }

    }

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
