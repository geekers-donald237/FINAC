<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeaponDeclaration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $weaponType;
    public $subject;
    public $serialNumber;
    public $isDeclarationOfPossesion;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $weaponType, $serialNumber , $isDeclarationOfPossesion)
    {
        $this->subject = $subject;
        $this->weaponType = $weaponType;
        $this->serialNumber = $serialNumber;
        $this->isDeclarationOfPossesion = $isDeclarationOfPossesion;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.weapon_declaration',
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
