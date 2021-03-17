<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use LoginTrait;

    private const URL = '/courses';

    public function testList()
    {
        $this->adminLogin();

        $response = $this->get(self::URL);

        $response->assertStatus(200);
    }

    public function testListWithoutPermission()
    {
        $this->userLogin();

        $response = $this->get(self::URL);

        $response->assertStatus(403);
    }

    public function testViewNotFoundCourse()
    {
        $this->userLogin();
        
        $response = $this->get(self::URL.'/12345');
        
        $response->assertNotFound();
    }
}
