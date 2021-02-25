<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
