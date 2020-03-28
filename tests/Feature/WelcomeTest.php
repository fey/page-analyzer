<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomeTest extends TestCase
{
    public function testWelcome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
