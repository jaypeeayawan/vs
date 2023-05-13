<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persons;
use App\Models\Voters;

class VotersRegistrationComponent extends Component
{
    public $firstname;
    public $middlename;
    public $lastname;

    protected $messages = [
        'firstname.required' => 'Firstname cannot be empty',
        'middlename.required' => 'Middlename cannot be empty',
        'lastname.required' => 'Lastname cannot be empty',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
        ]);
    }

    public function register()
    {
        $this->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
        ]);

        try{
            $person = new Persons();
            $person->firstname = $this->firstname;
            $person->middlename = $this->middlename;
            $person->lastname = $this->lastname;
            $person->photo = '';
            $person->save();

            $personsid = $person->id;

            $voter = new Voters();
            $voter->persons_id = $personsid;
            $voter->votersnumber = $personsid.''.random_int(10000000, 99999999);
            $voter->save();

            $votersid = $voter->id;

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'votersid' => $votersid,
                'type' => 'success',
                'message' => "Successfully registered!"
            ]);

            $this->resetInputFields();

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while saving!"
            ]);

            $this->resetInputFields();
        }
    }

    private function resetInputFields(){
        $this->firstname = '';
        $this->middlename = '';
        $this->lastname = '';
    }
    
    public function render()
    {
        $pageTitle = 'Voter Registration';
        return view('livewire.voters-registration-component',
            [
                'pageTitle' => $pageTitle,
            ]
        )
        ->layout('layouts.base');
    }
}
