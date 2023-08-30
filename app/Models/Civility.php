<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Civility extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'gender',
    ];

    public function person(): HasMany{
        return $this->hasMany(Person::class);        
    }
}
