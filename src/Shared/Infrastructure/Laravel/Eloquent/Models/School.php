<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_school_view');
    }
}
