<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHome()
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
