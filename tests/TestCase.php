<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected bool $dropViews = true;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('s3');
    }
}
