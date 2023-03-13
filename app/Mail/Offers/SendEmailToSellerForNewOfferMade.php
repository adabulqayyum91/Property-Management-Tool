<?php

namespace App\Mail\Offers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendEmailToSellerForNewOfferMade extends Mailable
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

    public function __construct($user =null, $venture = null, $subject = null)
    {
        $this->user = $user;
        $this->venture = $venture;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.current_ventures.offers.sendEmailToSellerForNewOfferMade', ['user' => $this->user, 'venture' => $this->venture])->subject($this->subject);
    }
}
