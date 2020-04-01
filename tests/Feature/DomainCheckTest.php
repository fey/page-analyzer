<?php

namespace Tests\Feature;

use Tests\TestCase;
use Http;

class DomainCheckTest extends TestCase
{
    public function testStore()
    {
        $fakeDomain = $this->faker->url;
        $fakeContent = file_get_contents(base_path('/tests/fixtures/analyzer.html'));
        Http::fake([
            $fakeDomain => Http::response($fakeContent, 200)
        ]);


        $fakeDomain = (object)[
            'name' => $fakeDomain,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $fakeDomain->id = \DB::table('domains')
            ->insertGetId((array)$fakeDomain);

        $response = $this->post(route('domains.checks.store', $fakeDomain->id));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('domain_checks', [
            'domain_id'     => $fakeDomain->id,
            'description'   => 'Seo Page analyzer',
            'keywords'      => 'hexlet php laravel project',
            'h1'            => 'Page Analyzer'
        ]);
    }
}
