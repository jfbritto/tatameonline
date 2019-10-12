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
        'idUser',
        'idContract',
        'idAcademy'
    ];
}
