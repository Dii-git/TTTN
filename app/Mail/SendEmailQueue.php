<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailQueue extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function build()
    {
        return $this->from("cao.huu.duy.150999@gmail.com")
                    ->subject('Laravel Training')
                    ->view('emails\sendMail')
                    ->with(['email' => $this->email]);
    }
}
