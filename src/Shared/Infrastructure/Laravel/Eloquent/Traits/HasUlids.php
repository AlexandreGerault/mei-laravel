<?php

namespace Shared\Infrastructure\Laravel\Eloquent\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Symfony\Component\Uid\Ulid;

trait HasUlids
{
    /**
     * Initialize the trait.
     *
     * @return void
     */
    public function initializeHasUlids()
    {
        $this->usesUniqueIds = true;
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array
     */
    public function uniqueIds()
    {
        return [$this->getKeyName()];
    }

    /**
     * Generate a new ULID for the model.
     *
     * @return string
     */
    public function newUniqueId()
    {
        return Str::ulid()->toBinary();
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation  $query
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        $binaryId = Ulid::fromString($value)->toBinary();

        //        if ($field && in_array($field, $this->uniqueIds())) {
        //            throw (new ModelNotFoundException)->setModel(get_class($this), $binaryId);
        //        }
        //
        //        if (! $field && in_array($this->getRouteKeyName(), $this->uniqueIds())) {
        //            throw (new ModelNotFoundException)->setModel(get_class($this), $binaryId);
        //        }

        return $query->where($field ?? $this->getRouteKeyName(), $binaryId)->first();
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        if (in_array($this->getKeyName(), $this->uniqueIds())) {
            return 'binary';
        }

        return $this->keyType;
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        if (in_array($this->getKeyName(), $this->uniqueIds())) {
            return false;
        }

        return $this->incrementing;
    }
}
