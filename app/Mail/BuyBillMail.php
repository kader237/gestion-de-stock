<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyBillMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $commande;
    public $stream;
    public function __construct($user,$commande,$stream)
    {
        //
        $this->user = $user;
        $this->commande = $commande;
        $this->stream = $stream;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.BuyBillMail')->attachData($this->stream,"facture.pdf");
    }
}
