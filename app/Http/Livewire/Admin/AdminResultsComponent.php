<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Votes;
use App\Models\Candidates;
use App\Models\ElectionForms;
use App\Models\Positions;
use \Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AdminResultsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // search variables
    public $searchByPosition;
    public $searchByForm;
    public $searchTerm;

    public function render()
    {

        $results = Votes::select(
            'persons.photo',
            'persons.lastname',
            'persons.firstname',
            'persons.middlename',
            'electionforms.title',
            'positions.positionname',
            DB::raw('COUNT(*) as total'),
            )
            ->when($this->searchByPosition, function($query){
                $query->where('positions_id', $this->searchByPosition);
            })
            ->when($this->searchByForm, function($query) {
                $query->where('votes.electionforms_id', $this->searchByForm);
            })
            ->leftJoin('candidates', 'votes.candidates_id', '=', 'candidates.id')
            ->leftJoin('persons', 'candidates.persons_id', '=', 'persons.id')
            ->leftJoin('electionforms', 'votes.electionforms_id', '=', 'electionforms.id')
            ->leftJoin('positions', 'candidates.positions_id', '=', 'positions.id')
            ->search(trim($this->searchTerm))
            ->groupBy(
                'votes.candidates_id',
                'votes.electionforms_id',
                'persons.photo',
                'persons.lastname',
                'persons.firstname',
                'persons.middlename',
                'electionforms.title',
                'positions.positionname'
            )
            ->orderBy('electionforms.title', 'DESC')
            ->orderBy('positions.order', 'ASC')
            ->paginate(10);

        $pageTitle = 'Election Results';
        return view('livewire.admin.admin-results-component',
            [
                'pageTitle' => $pageTitle,
                'results' => $results,
                'positions' => Positions::orderBy('order', 'asc')->get(),
                'forms' => ElectionForms::orderBy('title', 'asc')->get(),
            ]
        )
        ->layout('layouts.admin');
    }
}
