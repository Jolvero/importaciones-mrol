<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProformaPedimento extends Model
{
    //
    protected $fillable = [
        'name',
        'id_embarque',
        'referencia'
    ];
}
