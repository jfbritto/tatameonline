<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    protected $fillable = [
        'name',
        'hours',
        'idSport',
        'isActive',
    ];
}
