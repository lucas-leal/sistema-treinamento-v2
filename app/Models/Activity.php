<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public const NUMBER_OPTIONS = 4;
    
    use HasFactory, UuidTrait;

    public $incrementing = false;

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
