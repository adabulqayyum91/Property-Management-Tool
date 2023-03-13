<?php

namespace App\Mail\Offers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendEmailToBuyerForNewOfferMade extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $venture;
    public $subject;
    public $offer;


    public function __construct($user =null, $venture = null, $subject = null, $offer = null)
    {
        $this->user = $user;
        $this->venture = $venture;
        $this->subject = $subject;
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.current_ventures.offers.sendEmailToBuyerForNewOfferMade', ['user' => $this->user, 'venture' => $this->venture, 'offer' => $this->offer])->subject($this->subject);
    }
}
