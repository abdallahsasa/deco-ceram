<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShippingRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public QuoteRequest $quoteRequest;
    public int $totalWeight;
    public int $totalPallets;

    /**
     * Create a new message instance.
     */
    public function __construct(QuoteRequest $quoteRequest, ?int $totalWeight = null, ?int $totalPallets = null)
    {
        $this->quoteRequest = $quoteRequest;
        $this->totalWeight = $totalWeight ?? $quoteRequest->getTotalWeight();
        $this->totalPallets = $totalPallets ?? $quoteRequest->getTotalPallets();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande de devis pour transport de marchandises',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.shipping-request',
            with: [
                'totalWeight' => $this->totalWeight,
                'totalPallets' => $this->totalPallets,
            ],
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
