<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['qualification_id', 'trainee_id', 'trainer_id'];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class);
    }

    public function trainee(): BelongsTo
    {
        return $this->belongsTo(Trainee::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    public function remarks(): HasMany
    {
        return $this->hasMany(Remark::class);
    }

    public function getRemark(LearningOutcome $learn_outcome): Remark
    {
        $remark = Remark::where('learn_outcome_id', $learn_outcome->id)
            ->first();

        return $remark;
    }
}
