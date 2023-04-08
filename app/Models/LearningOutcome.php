<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningOutcome extends Model
{
    use HasFactory;

    protected $table = 'learn_outcomes';

    protected $fillable = ['competency_id', 'objective'];

    public function competency(): BelongsTo
    {
        return $this->belongsTo(Competency::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'learn_outcome_id');
    }
}
