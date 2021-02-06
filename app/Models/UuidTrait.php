<?php

namespace App\Models;

use Faker\Provider\Uuid;

trait UuidTrait
{
    public function save($options = [])
    {
        $this->id = $this->id ?? Uuid::uuid();

        parent::save($options);
    }
}