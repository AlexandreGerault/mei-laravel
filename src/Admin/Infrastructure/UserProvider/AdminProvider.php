<?php

declare(strict_types=1);

namespace Admin\Infrastructure\UserProvider;

use Admin\Infrastructure\Models\Admin;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Uid\Ulid;

class AdminProvider extends EloquentUserProvider
{
    /**
     * @param  string  $identifier
     * @return Authenticatable|Builder<Admin>|Model|null
     */
    public function retrieveById($identifier): Model|Builder|Authenticatable|null
    {
        $identifier = Ulid::fromString($identifier)->toBinary();
        $model = $this->createModel();

        return $this->newModelQuery($model)
            ->where($model->getAuthIdentifierName(), $identifier)
            ->first();
    }
}
