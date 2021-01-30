<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->login();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function login()
    {
        $this->post('/login', [
            'login' => 'admin',
            'password' => 'password'
        ]);
    }
}
