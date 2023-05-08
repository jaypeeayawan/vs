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

class AdminCandidatesComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    // public $personsid;
    public $firstname;
    public $middlename;
    public $lastname;
    public $photo;
    public $positionsid;
    public $electionformsid;

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

    private function resetInputFields(){
        $this->firstname = '';
        $this->middlename = '';
        $this->lastname = '';
        $this->positionsid = '';
        $this->electionformsid = '';
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
        $candidates = Candidates::when($this->searchByPosition, function($query){
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
