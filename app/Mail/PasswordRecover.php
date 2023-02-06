<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRecover extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subject;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;

        $this->subject = $details['subject'] ?? 'Password reset instructions';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('devpanel.emails.password.recover')
                    ->subject($this->subject)
                    ->with('details', $this->details);
    }
}
