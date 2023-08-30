<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'location_name',
    ];

    public function person(): belongsToMany
    {
        return $this->belongsToMany(Person::class);
    }
}
