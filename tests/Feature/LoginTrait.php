<?php

namespace Tests\Feature;

trait LoginTrait
{
    private function adminLogin()
    {
        $this->post('/login', [
            'login' => 'admin',
            'password' => 'abnt12'
        ]);
    }

    private function userLogin()
    {
        $this->post('/login', [
            'login' => 'lucasleal',
            'password' => 'abnt12'
        ]);
    }
}
