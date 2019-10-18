<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    protected $fillable = [
        'name',
        'siteName',
        'phone',
        'responsible',
        'phoneResponsible',
        'token',
        'isActive',
        'zipCode',
        'city',
        'neighborhood',
        'address',
        'number',
        'complement',
        'avatar',
        'latitude',
        'longitude',
    ];
}
