<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialism extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}