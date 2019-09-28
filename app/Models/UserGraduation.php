<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGraduation extends Model
{
    protected $fillable = [
        'startDate',
        'endDate',
        'isActive',
        'idUser',
        'idGraduation',
    ];
}