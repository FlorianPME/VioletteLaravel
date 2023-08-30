<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Person extends Model
{
    use HasFactory;
    protected $fillable = [
        'civility_id',
        'last_name',
        'first_name',
        'email',
        'phone',
        'organisation_id',
    ];

    public function civility(): BelongsTo{
        return $this->belongsTo(Civility::class);
    }

    public function organisation(): BelongsTo{
        return $this->belongsTo(Organisation::class);
    }

    public function locations(): BelongsToMany{
        return $this->belongsToMany(Location::class);
    }

    
}
