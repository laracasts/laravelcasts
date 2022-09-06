<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Mail\Mailable;

class NewPurchaseMail extends Mailable
{
    public function __construct(public Course $course)
    {
    }

    public function build(): self
    {
        return $this->markdown('emails.paddle-purchase');
    }
}
