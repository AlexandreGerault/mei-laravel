<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Shared\Infrastructure\Laravel\Eloquent\Casts\UlidCast;
use Shared\Infrastructure\Laravel\Eloquent\Traits\HasUlids;

class Specialism extends Model
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
     * @return BelongsTo<Discipline, Specialism>
     */
    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    /**
     * @return BelongsTo<School, Specialism>
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return BelongsToMany<Course>
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * @return BelongsToMany<Industry>
     */
    public function industries(): BelongsToMany
    {
        return $this->belongsToMany(Industry::class);
    }
}
