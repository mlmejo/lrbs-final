<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'user_id'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function qualifications(): BelongsToMany
    {
        return $this->belongsToMany(
            Qualification::class,
            'registrations',
            'trainee_id',
            'qualification_id',
        );
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
