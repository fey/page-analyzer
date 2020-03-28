<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DomainTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('domains.index'));

        for ($i = 0; $i < 5; $i += 1) {
            $this->createFakeDomain();
        }

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $domain = $this->faker->url;

        $response = $this->post(route('domains.store'), [
            'domain' => $domain
        ]);

        $this->assertDatabaseHas('domains', ['name' => parse_url($domain, PHP_URL_HOST)]);
        $response->assertRedirect();
    }

    public function testShow()
    {
        $id = $this->createFakeDomain();

        $response = $this->get(route('domains.show', $id));

        $response->assertOk();
    }

    private function createFakeDomain()
    {
        return \DB::table('domains')->insertGetId([
            'name' => $this->faker->domainName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
