<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'type',
        'description',
        'idUser',
        'isRead',
    ];
}
