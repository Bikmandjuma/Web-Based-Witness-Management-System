<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SendCodeResetPasswordMail
{
    use Queueable, SerializesModels;

    public $email;
    public $code;

    /**
     * Constructor.
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
    }

    /**
     * Render the Blade template to HTML.
     */
    public function render()
    {
        return view('emails.send-code-reset-password', ['code' => $this->code])->render();
    }
}
