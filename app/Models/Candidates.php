<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;

    protected $table = "candidates";

    public function persons()
    {
        return $this->belongsTo(Persons::class, 'persons_id');
    }

    public function positions()
    {
        return $this->belongsTo(Positions::class, 'positions_id');
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
                ->orWhere('electionforms_id', '=', $term);
            }
        );
    }

}
