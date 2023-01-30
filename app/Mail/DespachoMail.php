<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DespachoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $despachos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($despacho)
    {
        //
        $this->despachos = $despacho;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.despacho')->subject('Estatus de despacho')->from('no-reply@mrollogistics.com');
    }
}
