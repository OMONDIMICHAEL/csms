<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Communication;
use Carbon\Carbon;

class CommunicationNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $communication;

    /**
     * Create a new message instance.
     */
    public function __construct(Communication $communication)
    {
        $this->communication = $communication;
    }
    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New ' . ucfirst($this->communication->type) . ' - ' . $this->communication->title)
                    ->markdown('emails.communication_notification')
                    ->with([
                        'title' => $this->communication->title,
                        'message' => $this->communication->message,
                        'type' => ucfirst($this->communication->type),
                        'scheduled_at' => $this->communication->scheduled_at
    ? Carbon::parse($this->communication->scheduled_at)->format('d M Y, h:i A')
    : 'N/A',
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Communication Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
