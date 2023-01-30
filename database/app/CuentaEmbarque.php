<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaEmbarque extends Model
{
    //
    protected $fillable = [
        'name',
        'id_embarque',
        'referencia'
    ];
}
