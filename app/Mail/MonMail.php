<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonMail extends Mailable
{
    use Queueable, SerializesModels;

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

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Confirmation de creation de compte',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'Admin.mailCreation',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [
    //         new Attachment(
    //             data: $this->pdfPath,
    //             name: 'rib.pdf',
    //             options: [
    //                 'mime' => 'application/pdf',
    //             ]
    //         )
    //     ];
    // }

    public function build()
    {
        return $this->view('Mail.mailCreation')
                    ->subject('Confirmation de création de compte')
                    ->attachData($this->pdfPath, 'rib.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
