<?php

namespace App\Mail;

use App\Mail\Concerns\HasFaker;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Maintenance extends Mailable
{
    use Queueable, SerializesModels;
    use HasFaker;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.subject.maintenance', ['date' => $this->faker->date('Y/m/d')]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $from = Carbon::parse($this->faker->dateTimeBetween('now', '+1 month'));
        return new Content(
            markdown: "emails.{$this->locale}.maintenance",
            with: [
                'name' => $this->faker->name(),
                'from' => $from->format('Y-m-d H:i:s'),
                'to' => $from->addHours(random_int(1, 12))->format('Y-m-d H:i:s'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
