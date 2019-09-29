<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'checkedHour',
        'idRegistration',
        'idUserGraduation',
    ];
}