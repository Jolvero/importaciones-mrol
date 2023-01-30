<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    //
    protected $fillable = [
        'cliente_id',
        'color',
        'modelo',
        'cant_palet',
        'medidas_caja_individual',
        'medidas_caja_master',
        'imagen'
    ];

    // Obtiene el nombre del ciente via fk
    public function cliente()
    {
        return $this->belongsTo(ClienteAlmacen::class);
    }
    public function palet()
    {
        return $this->belongsTo(Palet::class);
    }
}
