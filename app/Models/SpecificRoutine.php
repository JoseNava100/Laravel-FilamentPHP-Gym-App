<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecificRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'series', 
        'repetitions', 
        'rest', 
        'category_id', 
        'routine_id', 
        'exercise_id'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function routine() : BelongsTo
    {
        return $this->belongsTo(Routine::class);
    }

    public function exercise() : BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
