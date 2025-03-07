<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssignFormationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $formation;

    public function __construct($user, $formation)
    {
        $this->user = $user;
        $this->formation = $formation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Formation Assignée à Vous',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.formation', 
            with: [
                'user' => $this->user,        
                'formation' => $this->formation, 
            ],
        );
    }
}
