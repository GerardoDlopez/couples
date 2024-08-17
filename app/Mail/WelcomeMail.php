<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

use Illuminate\Support\Facades\Log;
class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $name){}

    public function envelope(): Envelope
    {
        $prueba = env('MAIL_FROM_ADDRESS');
        Log::info('User email: ' . $prueba);
        return new Envelope(
            subject: 'Welcome to my api',
            from: new Address(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
