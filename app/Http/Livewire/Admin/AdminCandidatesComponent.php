<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Persons;
use App\Models\Candidates;
use App\Models\Positions;
use App\Models\ElectionForm;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminCandidatesComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';


    // search variables
    public $searchByPosition;
    public $searchByForm;
    public $searchTerm;

    public function render()
    {
        $pageTitle = 'Candidates Manager';
        $candidates = Candidates::when($this->searchByPosition, function($query){
                $query->where('positions_id', $this->searchByPosition);
            })
            ->when($this->searchByForm, function() {
                $query->where('electionforms_id', $this->searchByForm);
            })
            ->search(trim($this->searchTerm))
            ->paginate(10);

        return view('livewire.admin.admin-candidates-component',
            [
                'pageTitle' => $pageTitle,
                'candidates' => $candidates,
                'courses' => Course::orderBy('c_code', 'asc')->get()
            ]
        )
        ->layout('layouts.admin');
    }
}
