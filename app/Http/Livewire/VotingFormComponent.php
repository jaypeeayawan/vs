<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Persons;
use App\Models\Voters;
use App\Models\Candidates;
use App\Models\ElectionForms;
use App\Models\Positions;
use App\Models\Votes;

class VotingFormComponent extends Component
{
    public $votersid;
    // public $votersnumber;
    // public $firstname;
    // public $middlename;
    // public $lastname;

    public function mount($votersid)
    {
        $this->votersid = $votersid;
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
        foreach($positions as $position) {
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
                    <label><span class="font-weight-bolder">'.$position->positionname.'</span><span class="text-danger">*</span></label>';

                    $containerclass   = ($position->max_vote == 1) ? "radio-list" : "checkbox-list";
                    $contenttype = ($position->max_vote == 1) ? "radio" : "checkbox";

                    $candidates .= '<div class='.$containerclass.'>';
                    if($names->isEmpty()) {
                        $candidates .= '<span class="text-danger font-size-sm">*No candidate for this position</span>';
                    } else {
                        foreach($names as $name) {
                            $candidates .= '<label class='.$contenttype.'>
                                <input type="'.$contenttype .'" value="'.$name->candidatesid.'" input-data="'.$position->max_vote.'_'.$position->positionname.'_'.$name->lastname.', '.$name->firstname.' '.$name->middlename.'" name="'.str_replace(" ", "", $position->positionname).'">
                                <span></span>
                                '.$name->lastname.', '.$name->firstname.' '.$name->middlename.'
                            </label>';
                        }
                    }
                    $candidates .= '</div>
                </div>
            <div class="separator separator-dashed my-5"></div>';
        }

        return view('livewire.voting-form-component',
            [
                'pageTitle' => $pageTitle,
                'voter' => Voters::where('id', $this->votersid)->first(),
                'vote' => $vote,
                'form' => $form,
                'candidates' => $candidates,
            ]
        )
        ->layout('layouts.votingform');
    }
}
