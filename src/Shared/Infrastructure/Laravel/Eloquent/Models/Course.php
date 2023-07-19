<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Shared\Infrastructure\Laravel\Eloquent\Casts\UlidCast;
use Shared\Infrastructure\Laravel\Eloquent\Traits\HasUlids;

class Course extends Model
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
     * @return BelongsToMany<Admission>
     */
    public function admissions(): BelongsToMany
    {
        return $this->belongsToMany(Admission::class);
    }

    /**
     * @return BelongsToMany<Specialism>
     */
    public function specialisms(): BelongsToMany
    {
        return $this->belongsToMany(Specialism::class);
    }
}
