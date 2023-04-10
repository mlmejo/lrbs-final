<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Remark extends Model
{
    use HasFactory;

    protected $fillable = ['learn_outcome_id', 'content'];

    public function learn_outcome(): BelongsTo
    {
        return $this->belongsTo(LearningOutcome::class);
    }
}
