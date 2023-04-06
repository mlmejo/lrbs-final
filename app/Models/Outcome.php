<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outcome extends Model
{
    use HasFactory;

    protected $fillable = ['objective', 'competency_id'];

    public function competency(): BelongsTo
    {
        return $this->belongsTo(Competency::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
