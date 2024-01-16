<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'reference',
        'actionDate',
        'description',
        'idUser',
        'idHistoricType',
    ];

    public function type()
    {
        return $this->hasOne(\App\Models\HistoricType::class, 'id', 'idHistoricType');
    }
}
