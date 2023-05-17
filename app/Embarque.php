<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embarque extends Model
{

    //

    protected $fillable = [
        'cliente_id',
        'tipo_id',
        'mes_id',
        'referencia',
        'estado_id',
        'documentacion_id',
        'documentacion',
        'file_id',
        'prealertado',
        'arribo',
        'revalidación',
        'pedimento',
        'previo',
        'despacho',
        'despacho_id',
        'cuenta_gastos',
        'pago_anticipo',
        'uuid_cta_gastos',
        'uuid_kpi',
        'observaciones',
        'observaciones_pedimento',
        'user_id',
        'uuid'
    ];

    // Obtiene el estatus del embarque via FK
    public function estado()
    {
        return $this->belongsTo(EstadoEmbarque::class);
    }

    // Obtiene la información de documentación vía FK

    public function estadoDocumentacion()
    {
        return $this->belongsTo(DocumentacionEmbarque::class, 'documentacion_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function despachos()
    {
        return $this->belongsTo(Despacho::class, 'despacho_id');
    }

    public function mes()
    {
        return $this->belongsTo(Mes::class);
    }

}
