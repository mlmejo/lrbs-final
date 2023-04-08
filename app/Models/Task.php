<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['learn_outcome_id', 'title'];

    public function learn_outcome()
    {
        return $this->belongsTo(LearningOutcome::class, 'learn_outcome_id');
    }
}
