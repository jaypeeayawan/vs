<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Voters;
use App\Models\Persons;
use Livewire\WithPagination;

class AdminVotersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $personsid;
    public $firstname;
    public $middlename;
    public $lastname;
    public $photo;
    public $votersid;
    public $currentphoto;
    public $newphoto;

    // search variables
    public $searchTerm;

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

    public function store()
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

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Voter has been saved successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while saving voter!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');
        }
    }

     public function fetch($id)
    {
        $voter = Voters::where('id', $id)->first();
        $this->votersid = $id;
        $this->personsid = $voter->persons_id;
        $this->firstname = $voter->persons->firstname;
        $this->middlename = $voter->persons->middlename;
        $this->lastname = $voter->persons->lastname;
    }

    public function update()
    {
        $this->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
        ]);

        try{
            $person = Persons::find($this->personsid);
            $person->firstname = $this->firstname;
            $person->middlename = $this->middlename;
            $person->lastname = $this->lastname;
            $person->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Voter has been updated successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postUpdated');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while updating voter!"
            ]);

            $this->resetInputFields();
            $this->emit('postUpdated');
        }

    }

    public function delete()
    {
        try{
            if($this->votersid){
                Voters::where('id', $this->votersid)->delete();
                Persons::where('id', $this->personsid)->delete();

                // Set Flash Message
                $this->dispatchBrowserEvent('alert',[
                    'type' => 'success',
                    'message' => "Voter has been deleted succesfully!"
                ]);
            }
            
            $this->resetInputFields();
            $this->emit('postDeleted');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while deleting voter!"
            ]);
        }
    }

    private function resetInputFields(){
        $this->personsid = '';
        $this->firstname = '';
        $this->middlename = '';
        $this->lastname = '';
        $this->photo = '';
        $this->votersid = '';
        $this->votersnumber = '';
        $this->currentphoto = '';
        $this->newphoto = '';
    }

    public function cancel()
    {
        // this will remove input validation on modal close
        $this->resetErrorBag(); 
        // this will reset/remove input value on modal close
        $this->resetInputFields(); 
    }

    public function render()
    {
        $pageTitle = 'Voters Manager';
        $search = '%' .$this->searchTerm. '%';

        $voters = Persons::join('voters', 'persons.id', '=', 'voters.persons_id')
            ->where('persons.firstname', 'LIKE',  $search)
            ->orWhere('persons.middlename', 'LIKE',  $search)
            ->orWhere('persons.lastname', 'LIKE',  $search)
            ->orWhere('voters.votersnumber', 'LIKE',  $search)
            ->paginate(10);

        return view('livewire.admin.admin-voters-component',
            [
                'pageTitle' => $pageTitle,
                'voters' => $voters,
            ]
        )
        ->layout('layouts.admin');
    }
}
