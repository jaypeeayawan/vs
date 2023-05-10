<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    use HasFactory;

    protected $table = "voters";

    public function persons()
    {
        return $this->belongsTo(Persons::class, 'persons_id');
    }

}
