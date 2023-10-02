<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $casts = [];

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
