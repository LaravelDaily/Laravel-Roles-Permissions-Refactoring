<?php

namespace Tests;

use App\Policies\PermissionPolicies;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        PermissionPolicies::define();
    }
}
