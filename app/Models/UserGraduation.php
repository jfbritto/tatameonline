<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGraduation extends Model
{
    protected $fillable = [
        'startDate',
        'endDate',
        'isActive',
        'idUser',
    ];
}