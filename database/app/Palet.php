<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palet extends Model
{

    protected $fillable = [
        'n°_palet',
        'factura',
        'week',
        'modelo_id',
        'total',
        'cliente_id'
    ];
    //
    public function modelo()
    {
        return $this->belongsTo(Almacen::class);
    }
    public function cliente()
    {
        return $this->belongsTo(ClienteAlmacen::class);
    }
}
