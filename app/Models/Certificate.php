<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
