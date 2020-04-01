<?php

namespace Tests\Feature;

use Tests\TestCase;

class DomainTest extends TestCase
{
    public function testIndex()
    {
        for ($i = 0; $i < 5; $i += 1) {
            $this->createFakeDomain();
        }

        $response = $this->get(route('domains.index'));

        $response->assertOk();
    }

    public function testStore()
    {
        $fakeUrl = $this->faker->url;

        $response = $this->post(route('domains.store'), [
            'domain' => ['name' => $fakeUrl]
        ]);

        $expected = parse_url($fakeUrl, PHP_URL_HOST);

        $this->assertDatabaseHas('domains', ['name' => $expected]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testShow()
    {
        $id = $this->createFakeDomain();

        $response = $this->get(route('domains.show', $id));

        $response->assertOk();
    }

    public function testShowWithChecks()
    {
        $domainId = $this->createFakeDomain();

        for ($i = 0; $i < 5; $i += 1) {
            $this->createFakeChecks($domainId);
        }

        $response = $this->get(
            route('domains.show', $domainId)
        );

        $response->assertOk();
    }
}
