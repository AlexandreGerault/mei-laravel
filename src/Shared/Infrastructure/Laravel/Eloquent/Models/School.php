<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'long_description',
        'short_description',
        'website',
        'city',
        'address',
        'region',
        'department',
        'is_public',
        'foundation_year',
    ];

    public function specialisms(): HasMany
    {
        return $this->hasMany(Specialism::class, 'school_id');
    }
}
