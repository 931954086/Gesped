<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParecerDisponivel extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Parecer Disponível')
                    ->view('emails.parecer_disponivel');
    }
}
