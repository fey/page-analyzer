<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    use RefreshDatabase;


    protected function createFakeDomain()
    {
        return \DB::table('domains')
            ->insertGetId([
                'name' => $this->faker->url,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    protected function createFakeChecks($domainId)
    {
        return \DB::table('domain_checks')
            ->insertGetId([
                'domain_id' => $domainId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
