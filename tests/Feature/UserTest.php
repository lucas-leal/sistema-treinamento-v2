<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    use LoginTrait;
    
    public function testListWithAdmin()
    {
        $this->adminLogin();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testListWithUser()
    {
        $this->userLogin();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
