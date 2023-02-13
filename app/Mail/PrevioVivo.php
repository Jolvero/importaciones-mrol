<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class PrevioVivo extends Mailable
{
    public $previoVivo;
    public $fotos;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($previo, $foto)
    {
        //
        $this->previoVivo = $previo;
        $this->fotos = $foto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('email.previo')->subject('Evidencias Previo')->from('no-reply@mrollogistics.com');
        foreach($this->fotos as $foto)
        {
            $email->attach($foto);
        }

    }
}
