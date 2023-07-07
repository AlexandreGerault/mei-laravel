<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shared\Infrastructure\Laravel\Eloquent\Casts\UlidCast;
use Shared\Infrastructure\Laravel\Eloquent\Traits\HasUlids;

class Discipline extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'description',
        'color',
    ];

    protected $casts = [
        'id' => UlidCast::class,
    ];
}
