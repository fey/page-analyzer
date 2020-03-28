<?php

namespace Tests\Feature;

use Tests\TestCase;

class DomainCheckTest extends TestCase
{
    public function testStore()
    {
        $domainId = $this->createFakeDomain();

        $response = $this->post(route('domains.checks.store', $domainId));

        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', ['domain_id' => $domainId]);
    }
}
