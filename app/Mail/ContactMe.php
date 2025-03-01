<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    /**
     * Create a new message instance.
     */
    public function __construct($sender)
    {
        $this->sender = (object)$sender;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $sender = $this->sender;
        return new Envelope(
            subject: $sender->subject,
            replyTo: [
                new Address($sender->email, $sender->full_name),
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-me',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
