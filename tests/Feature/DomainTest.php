<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DomainTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/');

        for ($i = 0; $i < 5; $i += 1) {
            $this->createFakeDomain();
        }

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $domain = $this->faker->domainName;

        $response = $this->post(route('domains.store'), [
            'domain' => $domain
        ]);

        \Log::debug($response->content());

        $this->assertDatabaseHas('domains', ['domain' => $domain]);
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
