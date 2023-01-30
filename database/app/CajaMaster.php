<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CajaMaster extends Model
{
    //
    protected $fillable = [
        'factura',
        'n°_caja_master',
        'palet_id'
    ];

    public function palet()
    {
        return $this->belongsTo(Palet::class);
    }
}
