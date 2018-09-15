<?php

namespace App\Mail;

use App\Entities\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Message
     */
    private $message;

    /**
     * SendMessage constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(env('MAIL_ADMIN'))
            ->subject($this->message->subject)
            ->view('mails.message')
            ->with([
                'messageText' => $this->message->message
            ]);
    }
}
