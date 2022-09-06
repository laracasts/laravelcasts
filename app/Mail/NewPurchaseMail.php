<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class NewPurchaseMail extends Mailable
{
    public function __construct()
    {
    }

    public function build(): self
    {
        return $this->markdown('emails.paddle-purchase');
    }
}
