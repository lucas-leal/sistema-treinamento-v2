<?php

namespace Tests\Feature;

trait LoginTrait
{
    private function adminLogin()
    {
        $this->post('/login', [
            'login' => 'admin',
            'password' => 'password'
        ]);
    }

    private function userLogin()
    {
        $this->post('/login', [
            'login' => 'user',
            'password' => 'password'
        ]);
    }
}
