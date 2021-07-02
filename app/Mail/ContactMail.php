<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Http\Controllers\VisitorsController;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_datas)
    {
        $this->mail_datas = $mail_datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return 
        $this->subject($this->mail_datas['subject'])
        ->from($this->mail_datas['email'])
        ->replyTo($this->mail_datas['email'], $this->mail_datas['username'])
        ->markdown('emails.contactmail')->with([
            'mail_datas_array' => $this->mail_datas
        ]);
    }
}
