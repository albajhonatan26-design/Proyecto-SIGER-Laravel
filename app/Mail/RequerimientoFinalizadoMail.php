<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\DesarrolloRequerimiento;

class RequerimientoFinalizadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $desarrollo;
    public $novedad;

    public function __construct(DesarrolloRequerimiento $desarrollo, $novedad)
    {
        $this->desarrollo = $desarrollo;
        $this->novedad = $novedad;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Requerimiento Finalizado - SIGER',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'requerimiento.requerimiento_finalizado',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}