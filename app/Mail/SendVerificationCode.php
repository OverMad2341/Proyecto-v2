<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * El código de verificación.
     *
     * @var string
     */
    public $code;

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Obtiene el sobre del mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu Código de Verificación',
        );
    }

    /**
     * Obtiene la definición del contenido del mensaje.
     * (Esta es la vista de la que hablaste)
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verification-code', // La crearemos en el Paso 4
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