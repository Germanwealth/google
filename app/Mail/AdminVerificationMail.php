<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $verificationLink)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm your email address',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-verification',
            with: [
                'verificationLink' => $this->verificationLink,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
