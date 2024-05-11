<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mailCompteCourant extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $userData;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($userData, $pdfPath)
    {
        $this -> userData = $userData;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->view('Mail.mailCreation')
                    ->subject('Confirmation de création de compte')
                    ->attachData($this->pdfPath, 'rib.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
