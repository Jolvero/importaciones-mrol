<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Kpis extends Mailable
{
    use Queueable, SerializesModels;

    public $kpis;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($kpi)
    {
        //
        $this->kpis= $kpi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.kpis')->subject('KPIs' . ' ' . date('m'));
    }
}
