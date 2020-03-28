<?php

namespace Tests\Feature;

use Tests\TestCase;
use Http;

class DomainCheckTest extends TestCase
{
    public function testStore()
    {
        $fakeDomain = $this->faker->url;
        Http::fake([
            $fakeDomain => Http::response('', 200)
        ]);

        $domainId = $this->createFakeDomain($fakeDomain);

        $response = $this->post(route('domains.checks.store', $domainId));

        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', ['domain_id' => $domainId]);
    }
}
