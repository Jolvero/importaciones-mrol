<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //

    // Relación 1:1 de perfil y usuario

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
