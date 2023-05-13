<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Persons;
use App\Models\Candidates;
use App\Models\Positions;
use App\Models\ElectionForms;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AdminCandidatesComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $personsid;
    public $firstname;
    public $middlename;
    public $lastname;
    public $photo;
    public $candidatesid;
    public $positionsid;
    public $electionformsid;
    public $currentphoto;
    public $newphoto;

    // search variables
    public $searchByPosition;
    public $searchByForm;
    public $searchTerm;

    protected $messages = [
        'photo.required' => 'Photo is required',
        'firstname.required' => 'Firstname cannot be empty',
        'middlename.required' => 'Middlename cannot be empty',
        'lastname.required' => 'Lastname cannot be empty',
        'positionsid.required' => 'Postion cannot be empty',
        'electionformsid.required' => 'Election form cannot be empty',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'photo' => 'required|mimes:jpeg,png',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'positionsid' => 'required',
            'electionformsid' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'photo' => 'required|mimes:jpeg,png',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'positionsid' => 'required',
            'electionformsid' => 'required',
        ]);

        try{
            $person = new Persons();
            $person->firstname = $this->firstname;
            $person->middlename = $this->middlename;
            $person->lastname = $this->lastname;
            if($this->photo){
                $photoname = Carbon::now()->timestamp.'.'.$this->photo->extension();
                $this->photo->storeAs('photos', $photoname);
            }else{
                $photoname =  '';
            }
            $person->photo = $photoname;
            $person->save();

            $personsid = $person->id;

            $candidate = new Candidates();
            $candidate->persons_id = $personsid;
            $candidate->positions_id = $this->positionsid;
            $candidate->electionforms_id = $this->electionformsid;
            $candidate->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Candidate has been saved successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while saving candidate!"
            ]);

            $this->resetInputFields();
            $this->emit('postStored');
        }
    }

     public function fetch($id)
    {
        $candidate = Candidates::where('id', $id)->first();
        $this->candidatesid = $id;
        $this->personsid = $candidate->persons_id;
        $this->positionsid = $candidate->positions_id;
        $this->electionformsid = $candidate->electionforms_id;
        $this->firstname = $candidate->persons->firstname;
        $this->middlename = $candidate->persons->middlename;
        $this->lastname = $candidate->persons->lastname;
        $this->currentphoto = $candidate->persons->photo;
    }

    public function update()
    {
        $this->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'positionsid' => 'required',
            'electionformsid' => 'required',
        ]);

        try{
            $person = Persons::find($this->personsid);
            $person->firstname = $this->firstname;
            $person->middlename = $this->middlename;
            $person->lastname = $this->lastname;

            if($this->newphoto){
                $photoname = Carbon::now()->timestamp.'.'.$this->newphoto->extension();
                $this->newphoto->storeAs('photos', $photoname);
                $person->photo = $photoname;
            }
            $person->save();

            $candidate = Candidates::find($this->candidatesid);
            $candidate->positions_id = $this->positionsid;
            $candidate->electionforms_id = $this->electionformsid;
            $candidate->save();

            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'success',
                'message' => "Candidate has been updated successfully!"
            ]);

            $this->resetInputFields();
            $this->emit('postUpdated');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while updating candidate!"
            ]);

            $this->resetInputFields();
            $this->emit('postUpdated');
        }

    }

    public function delete()
    {
        try{
            if($this->candidatesid){
                Candidates::where('id', $this->candidatesid)->delete();
                Persons::where('id', $this->personsid)->delete();

                if(public_path('photos/photos/'.$this->currentphoto)){
                    File::delete(public_path('photos/photos/'.$this->currentphoto));
                }

                // Set Flash Message
                $this->dispatchBrowserEvent('alert',[
                    'type' => 'success',
                    'message' => "Candidate has been deleted succesfully!"
                ]);
            }
            
            $this->resetInputFields();
            $this->emit('postDeleted');

        }catch(\Exception $e){
            // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type' => 'error',
                'message' => "Something went wrong while deleting candidate!"
            ]);
        }
    }

    private function resetInputFields(){
        $this->personsid = '';
        $this->firstname = '';
        $this->middlename = '';
        $this->lastname = '';
        $this->photo = '';
        $this->candidatesid = '';
        $this->positionsid = '';
        $this->electionformsid = '';
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
        $pageTitle = 'Candidates Manager';
        $candidates = Candidates::select(
                'candidates.id as candidatesid',
                'candidates.positions_id',
                'candidates.electionforms_id',
                'persons.id as personsid',
                'persons.firstname',
                'persons.middlename',
                'persons.lastname',
                'persons.photo'
            )
            ->when($this->searchByPosition, function($query){
                $query->where('positions_id', $this->searchByPosition);
            })
            ->when($this->searchByForm, function($query) {
                $query->where('electionforms_id', $this->searchByForm);
            })
            ->leftJoin('persons', function($query) {
                 $query->on('persons.id', '=', 'candidates.persons_id');
            })
            ->search(trim($this->searchTerm))
            ->orderBy('electionforms_id', 'desc')
            ->paginate(10);

        return view('livewire.admin.admin-candidates-component',
            [
                'pageTitle' => $pageTitle,
                'candidates' => $candidates,
                'positions' => Positions::orderBy('order', 'asc')->get(),
                'forms' => ElectionForms::orderBy('title', 'asc')->get(),
            ]
        )
        ->layout('layouts.admin');
    }
}
