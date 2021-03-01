<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations');
    }

    public function activities()
    {
        return $this->hasManyThrough(Activity::class, Unit::class);
    }
}
