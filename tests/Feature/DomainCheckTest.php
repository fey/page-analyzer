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

        $domainId = $this->createFakeDomain($fakeDomain);

        $response = $this->post(route('domains.checks.store', $domainId));

        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', [
            'domain_id'     => $domainId,
            'description'   => 'Seo Page analyzer',
            'keywords'      => 'hexlet php laravel project',
            'h1'            => 'Page Analyzer'
        ]);
    }
}
