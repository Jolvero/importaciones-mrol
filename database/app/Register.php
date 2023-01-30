<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
    protected $fillable = [
        'name',
        'id_rol',
        'email',
        'password'
    ];
}
