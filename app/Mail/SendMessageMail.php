<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $senderName;
    public $subject;
    public $messageType;
    public $attachmentPath;

    public function __construct($messageContent, $senderName, $subject, $messageType, $attachmentPath = null)
    {
        $this->messageContent = $messageContent;
        $this->senderName = $senderName;
        $this->subject = $subject;
        $this->messageType = $messageType;
        $this->attachmentPath = $attachmentPath;
    }

    public function build()
    {
        $email = $this->subject($this->subject)
                      ->from(config('mail.from.address'), $this->senderName)
                      ->view('emails.send_message')
                      ->with([
                          'messageContent' => $this->messageContent,
                          'messageType' => $this->messageType
                      ]);

        // Attach file if exists based on message type
        if ($this->attachmentPath) {
            $email->attach($this->attachmentPath);
        }

        return $email;
    }
}
