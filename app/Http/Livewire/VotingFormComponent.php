<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persons;
use App\Models\Voters;
use App\Models\ElectionForms;
use App\Models\Positions;
use App\Models\Votes;

class VotingFormComponent extends Component
{
    public $votersid;
    public $selectedcandidates = [];

    public function mount($votersid)
    {
        $this->votersid = $votersid;
    }

    public function submit()
    {
        $votedcandidates = $this->selectedcandidates;
        foreach ($votedcandidates as $votedcandidate) {
            $candidatesdata = explode('_', $votedcandidate);
            $candidatesid = $candidatesdata[0];
            $electformsid = $candidatesdata[1];

            $vote = new Votes();
            $vote->voters_id = $this->votersid;
            $vote->candidates_id = $candidatesid;
            $vote->electionforms_id = $electformsid;
            $vote->save();
        }

        // Set Flash Message
        $this->dispatchBrowserEvent('alert', [
            'votersid' => $this->votersid,
            'type' => 'success',
            'message' => "Thank you for voting!"
        ]);
    }

    public function render()
    {
        $pageTitle = 'Voting Form';
        $form = ElectionForms::where('isactive', 1)
            ->first();
        $vote = Votes::where('voters_id', $this->votersid)
            ->where('electionforms_id', $form->id)
            ->first();
        $candidates = '';

        $positions = Positions::orderby('order', 'asc')->get();
        foreach ($positions as $position) {
            $names = Persons::select(
                'electionforms.id as electionformsid',
                'electionforms.title',
                'candidates.id as candidatesid',
                'persons.firstname',
                'persons.middlename',
                'persons.lastname'
            )
                ->join('candidates', 'persons.id', '=', 'candidates.persons_id')
                ->join('electionforms', 'candidates.electionforms_id', '=', 'electionforms.id')
                ->where('candidates.positions_id', $position->id)
                ->where('electionforms.isactive', 1)
                ->get();
            $candidates .= '<div class="form-group">
                    <label><span class="font-weight-bolder">' . $position->positionname . '</span><span class="text-danger">*</span></label>';

            $containerclass   = ($position->max_vote == 1) ? "radio-list" : "checkbox-list";
            $contenttype = ($position->max_vote == 1) ? "radio" : "checkbox";

            $candidates .= '<div class=' . $containerclass . '>';
            if ($names->isEmpty()) {
                $candidates .= '<span class="text-danger font-size-sm">*No candidate for this position</span>';
            } else {
                foreach ($names as $name) {
                    $inputname = ($position->max_vote > 1) ? str_replace(" ", "", $position->positionname) . '[]' : str_replace(" ", "", $position->positionname);
                    $candidates .= '<label class=' . $contenttype . '>
                        <input 
                            type="' . $contenttype . '" 
                            value="' . $name->candidatesid . '_' . $name->electionformsid . '" 
                            name="' . $inputname . '"
                            input-data="' . $position->positionname . '_' . $name->lastname . ', ' . $name->firstname . ' ' . $name->middlename . '" 
                            max-vote="' . $position->max_vote . '"
                            wire:model.defer="selectedcandidates.' . $name->candidatesid . '"
                        >
                        <span></span>
                        ' . $name->lastname . ', ' . $name->firstname . ' ' . $name->middlename . '
                    </label>';
                }
            }
            $candidates .= '</div>
            </div>
            <div class="separator separator-dashed my-5"></div>';
        }

        return view(
            'livewire.voting-form-component',
            [
                'pageTitle' => $pageTitle,
                'voter' => Voters::where('id', $this->votersid)->first(),
                'vote' => $vote,
                'form' => $form,
                'positions' => $positions,
                'candidates' => $candidates,
            ]
        )
            ->layout('layouts.votingform');
    }
}
