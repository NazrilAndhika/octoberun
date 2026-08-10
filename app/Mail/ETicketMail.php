<?php

namespace App\Mail;

use App\Models\Participant;
use App\Models\EventSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ETicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $settings;

    /**
     * Create a new message instance.
     */
    public function __construct(Participant $participant, EventSetting $settings)
    {
        $this->participant = $participant;
        $this->settings = $settings;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-Ticket & Info Race Pack - ' . ($this->settings->event_name ?? 'OCTOBERUN 2026'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.eticket',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
