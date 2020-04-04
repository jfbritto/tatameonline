<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'isActive',
        'isRoot',
        'isAdmin',
        'isInstructor',
        'isStudent',
        'idAcademy',
        'phone',
        'cpf',
        'birth',
        'responsible',
        'phoneResponsible',
        'zipCode',
        'city',
        'neighborhood',
        'address',
        'number',
        'complement',
        'avatar',
        'observation',
    ];

    public function academy()
    {
        return $this->hasOne(\App\Models\Academy::class, 'id', 'idAcademy');
    }

}
