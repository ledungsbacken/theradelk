<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subscriber extends Mailable
{
    use Queueable, SerializesModels;

    const FROM_ADDRESS = 'noreply@theradelk.com';
    const EMAIL_VIEW = 'emails.subscriber';

    private $emailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(self::FROM_ADDRESS)
             ->view(self::EMAIL_VIEW)
             ->with(['messages' => $this->emailData]);
    }
}
