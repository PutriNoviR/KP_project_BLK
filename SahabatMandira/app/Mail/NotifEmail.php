<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $namauser;
    public $konten;
    public function __construct($data)
    {
        //
        $this->namauser = $data['namauser'];
        $this->konten = $data['konten'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->subject('Sahabat Mandiri')
            ->view('email.coba');
    }
}
