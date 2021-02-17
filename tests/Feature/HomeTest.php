<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use LoginTrait;

    public function testHome()
    {
        $this->adminLogin();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
