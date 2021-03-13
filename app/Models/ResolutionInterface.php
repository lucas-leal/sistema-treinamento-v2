<?php

namespace App\Models;

interface ResolutionInterface
{
    public function calculateScore(): float;
    public function isPassed(): bool;
    public function isValid(): bool;
}
