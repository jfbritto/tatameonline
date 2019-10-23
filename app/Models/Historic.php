<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'idHistoricType',
        'idUser',
        'reference',
        'actionDate',
        'description',
    ];

    public function type()
    {
        return $this->hasOne(\App\Models\HistoricType::class, 'id', 'idHistoricType');
    }
}
