<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function pathway(): BelongsTo
    {
        return $this->belongsTo(Pathway::class);
    }
}
