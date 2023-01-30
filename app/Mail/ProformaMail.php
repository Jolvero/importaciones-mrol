<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProformaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $importaciones;
    public $proformas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($importacion, $proforma)
    {
        //
        $this->importaciones = $importacion;
        $this->proformas = $proforma;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.proforma')->subject('Proforma')->from('no-reply@mrollogistics.com')->attach($this->proformas);
    }
}
