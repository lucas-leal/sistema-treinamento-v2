<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
