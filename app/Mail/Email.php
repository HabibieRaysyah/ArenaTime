<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDO;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public function build(){
         return $this->subject('Test Email from ARENATIME')
                    ->view('email.emailtest');
    }
}
