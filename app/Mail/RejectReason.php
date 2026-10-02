<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class RejectReason extends Mailable
{
    use Queueable, SerializesModels;

    public $article;
    public $reason;
    public function __construct(Article $article,?string $reason)
    {
        $this->article=$article;
        $this->reason =$reason;
    }

   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reject Reason',
        );
    }

   
    public function content(): Content
    {
        return new Content(
            view: 'mail.reject-reason',
        );
    }

    
    
}
