<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'teacher',
        'weekDay',
        'hour',
        'timeLesson',
        'isActive',
        'idSport',
        'idAcademy',
    ];

    public function academy()
    {
        return $this->hasOne(\App\Models\Academy::class, 'id', 'idAcademy');
    }

    public function sport()
    {
        return $this->hasOne(\App\Models\Sport::class, 'id', 'idSport');
    }
}