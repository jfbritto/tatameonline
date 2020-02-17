<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'value',
        'dueDate',
        'isPaid',
        'paymentDate',
        'tokenPayment',
        'idUserReceived',
        'idUser',
        'idContract',
        'idAcademy'
    ];

    public function academy()
    {
        return $this->hasOne(\App\Models\Academy::class, 'id', 'idAcademy');
    }

    public function userReceived()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'idUserReceived');
    }

    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'idUser');
    }

    public function contract()
    {
        return $this->hasOne(\App\Models\Contract::class, 'id', 'idContract');
    }
}
