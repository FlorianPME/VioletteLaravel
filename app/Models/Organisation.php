<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisation_name',
        'sector_id',
        'chiffre_affaires',
        'postal_code',
        'city',
    ];

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function sector(): BelongsTo{
        return $this->belongsTo(Sector::class);
    }
}


