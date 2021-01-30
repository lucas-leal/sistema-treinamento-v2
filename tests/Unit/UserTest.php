<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsAdmin()
    {
        $user = new User();
        $user->admin = true;

        $this->assertTrue($user->isAdmin());
    }

    public function testIsNotAdmin()
    {
        $user = new User();
        $user->admin = false;

        $this->assertFalse($user->isAdmin());
    }
}
