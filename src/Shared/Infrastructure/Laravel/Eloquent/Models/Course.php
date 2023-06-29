<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
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
