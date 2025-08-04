<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Log;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketData;

    public function __construct($ticketData)
    {
        $this->ticketData = $ticketData;

        // Debugging (opsional)
        Log::info('TicketCreated data', $ticketData);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Ticket Submitted'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_created',
            with: ['data' => $this->ticketData]
        );
    }

    public function attachments(): array
    {
        if (!empty($this->ticketData['attachment'])) {
            $fullPath = storage_path('app/' . $this->ticketData['attachment']);
            
            Log::info('Attachment path', [
                'path' => $fullPath,
                'exists' => file_exists($fullPath)
            ]);

            if (file_exists($fullPath)) {
                return [Attachment::fromPath($fullPath)];
            }
        }

        return [];
    }
}
