<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Laravel\Eloquent\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Uid\Ulid;

class UlidCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return Ulid::fromBinary($value)->toRfc4122();
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return Ulid::fromString($value)->toBinary();
    }
}
