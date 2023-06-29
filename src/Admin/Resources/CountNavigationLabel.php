<?php

namespace Admin\Resources;

trait CountNavigationLabel
{
    protected static function getNavigationLabel(): string
    {
        $count = self::$model::count();

        return self::getPluralModelLabel().($count > 0 ? " ({$count})" : '');
    }
}
