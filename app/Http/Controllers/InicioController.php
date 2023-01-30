<?php

namespace App\Http\Controllers;

use App\Embarque;
use App\EstadoEmbarque;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        if (Auth::user()->rol_id !=3)
        {

            return redirect()->action('DashboardController@index');
        }
        else
         {
        return redirect()->action('ClienteController@embarquesCliente');
        }
    }
}
