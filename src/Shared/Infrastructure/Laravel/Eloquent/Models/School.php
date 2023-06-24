<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
