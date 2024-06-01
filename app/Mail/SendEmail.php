<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $sendTo;

    public $subject;

    public $content;

    public $view;

    public $attachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendTo, $subject, $content, $view, $attachment = [])
    {
        $this->sendTo     = $sendTo;
        $this->content    = $content;
        $this->subject    = $subject;
        $this->view       = $view;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
          ->with([
            'nama'    => $this->sendTo,
            'subject' => $this->subject,
            'content' => $this->content,
          ])
          ->subject($this->subject);
    }
}
