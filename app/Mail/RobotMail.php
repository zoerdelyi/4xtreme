<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Http\Controllers\VisitorsController;

class RobotMail extends Mailable
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
        ->from($this->mail_datas['from_email'], $this->mail_datas['from_name'])
        ->replyTo($this->mail_datas['from_email'], $this->mail_datas['name'])
        ->markdown('emails.robotmail')->with([
            'mail_datas_array' => $this->mail_datas
        ]);
    }
}
