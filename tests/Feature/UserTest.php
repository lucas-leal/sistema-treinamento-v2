<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function testList()
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
