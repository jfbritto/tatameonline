<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $fillable = [
        'name',
        'siteName',
        'phone',
        'responsable',
        'phoneResponsable',
        'token',
        'isActive',
    ];
}
