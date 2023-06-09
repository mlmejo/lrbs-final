<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competency extends Model
{
    use HasFactory;

    protected $fillable = ['qualification_id', 'category', 'title'];

    public function learn_outcomes(): HasMany
    {
        return $this->hasMany(LearningOutcome::class);
    }

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }
}
