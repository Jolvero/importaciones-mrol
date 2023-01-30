<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embarque extends Model
{

    //

    protected $fillable = [
        'referencia',
        'estado_id',
        'documentacion_id',
        'file_id',
        'prealertado',
        'arribo',
        'revalidación',
        'pedimento',
        'previo',
        'cuenta_gastos',
        'uuid_cta_gastos',
        'observaciones',
        'user_id',
        'uuid'
    ];

    // Obtiene el estatus del embarque via FK
    public function estado()
    {
        return $this->belongsTo(EstadoEmbarque::class);
    }

    // Obtiene la información de documentación vía FK

    public function documentacion()
    {
        return $this->belongsTo(DocumentacionEmbarque::class);
    }

    //Relación de archivos de documentacion con el embarque

    public function archivo()
    {
        return $this->hasMany(ArchivoEmbarque::class);
    }
}
