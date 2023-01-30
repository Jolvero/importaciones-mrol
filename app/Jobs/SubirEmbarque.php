<?php

namespace App\Jobs;

use App\Kpi;
use App\File;
use App\Embarque;
use Ramsey\Uuid\Uuid;
use App\CuentaEmbarque;
use App\ProformaPedimento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SubirEmbarque implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $requests;
    public $users;
    public $datas;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request, $data, Auth $user)
    {
        //
        $this->requests = $request;
        $this->users = $user::user()->name;
        $this->datas = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //


    }
}
