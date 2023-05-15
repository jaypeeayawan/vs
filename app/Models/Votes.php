<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    protected $table = "votes";

    public function voters()
    {
        return $this->belongsTo(Voters::class, 'voters_id');
    }

    public function candidates()
    {
        return $this->belongsTo(Candidates::class, 'candidates_id');
    }

    public function electionforms()
    {
        return $this->belongsTo(ElectionForms::class, 'electionforms_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('positions_id', '=', $term)
                ->orWhere('firstname', 'LIKE', $term)
                ->orWhere('middlename', 'LIKE', $term)
                ->orWhere('lastname', 'LIKE', $term)
                ->orWhere('votes.electionforms_id', '=', $term);
            }
        );
    }
}
