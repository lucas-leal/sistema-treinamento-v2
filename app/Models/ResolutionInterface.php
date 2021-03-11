<?php

namespace App\Models;

interface ResolutionInterface
{
    public function calculateScore(): float;
}
