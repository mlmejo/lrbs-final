<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'duration'];

    public function competencies(): HasMany
    {
        return $this->hasMany(Competency::class);
    }

    public function program(): BelongsToMany
    {
        return $this->belongsToMany(Program::class);
    }
}
