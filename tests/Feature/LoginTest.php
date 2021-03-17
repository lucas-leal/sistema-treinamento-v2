<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    use LoginTrait;

    private const URL = '/login';

    public function testLogin()
    {
        $this->post('/login', [
            'login' => 'admin',
            'password' => 'abnt12'
        ]);

        $response = $this->get('/');
        $response->assertOk();
    }

    public function testWrongCredentials()
    {
        $this->post('/login', [
            'login' => 'worong',
            'password' => '2wrong5'
        ]);

        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
