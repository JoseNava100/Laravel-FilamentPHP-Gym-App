<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'duration', 
        'level'
    ];

    public function specificRoutines() : HasMany
    {
        return $this->hasMany(SpecificRoutine::class);
    }
}
