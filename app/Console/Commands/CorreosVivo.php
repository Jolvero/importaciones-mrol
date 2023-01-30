<?php

namespace App\Console\Commands;

use App\Cliente;
use App\Embarque;
use App\Mail\DespachoMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CorreosVivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correos:vivo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia correos cada 30 min de estatus a vivo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $embarquesVivo = Embarque::where('cliente_id', 2)->where('estado_id', 6)->where('despacho_id', '<>', 5)->get();

        $contar = $embarquesVivo->count();

        if($contar> 0)
        {
            Mail::to('sistemas@mrollogistics.com.mx')->send(new DespachoMail($embarquesVivo));

        }

    }
}
