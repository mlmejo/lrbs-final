<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'abbrv'];

    public function qualifications(): BelongsToMany
    {
        return $this->belongsToMany(Qualification::class);
    }

    public function trainees(): HasMany
    {
        return $this->hasMany(Trainee::class);
    }
}
