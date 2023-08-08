<?php

namespace App\Http\Controllers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShippedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(protected $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hi, what\'s up',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.mail',
            with: [
                'title' => $this->data['title'],
                'content' => $this->data['content']
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
