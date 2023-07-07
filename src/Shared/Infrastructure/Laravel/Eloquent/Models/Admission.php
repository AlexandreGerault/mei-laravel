<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shared\Infrastructure\Laravel\Eloquent\Casts\UlidCast;
use Shared\Infrastructure\Laravel\Eloquent\Traits\HasUlids;

class Admission extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [
        'id' => UlidCast::class,
    ];

    /**
     * @return BelongsTo<Pathway, Admission>
     */
    public function pathway(): BelongsTo
    {
        return $this->belongsTo(Pathway::class);
    }
}
