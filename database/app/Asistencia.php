<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    //
    protected $fillable = [
        'usuario',
        'fecha',
    ];

    public function usuarios()
    {
        return $this->belongsTo(Register::class);
    }
}

