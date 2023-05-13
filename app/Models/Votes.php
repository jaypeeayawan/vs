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
}
