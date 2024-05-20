<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'muscle_group', 
        'recommended_equipment', 
        'level_of_difficulty'
    ];

    public function specificRoutines() : HasMany
    {
        return $this->hasMany(SpecificRoutine::class);
    }
}
