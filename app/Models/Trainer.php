<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(Registration::class);
    }

    public function trainees(): BelongsToMany
    {
        return $this->belongsToMany(
            Trainee::class,
            'registrations',
            'trainer_id',
            'trainee_id',
        );
    }
}
