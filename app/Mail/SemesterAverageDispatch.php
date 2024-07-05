<?php

namespace App\Mail;

use App\Models\SapM\TempMatricula;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SemesterAverageDispatch extends Mailable
{
    use Queueable, SerializesModels;

    public $tempMatricula;

    /**
     * Create a new message instance.
     */
    public function __construct(TempMatricula $tempMatricula)
    {
        $this->tempMatricula = $tempMatricula;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address('noreply1@comunicacionesusmp.edu.pe', 'No responder - FCCTP'),
            subject: "Solicitud de promedio ponderado",
        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.semester_average_dispatch',
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
