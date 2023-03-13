<?php

namespace App\Mail\BuyNow;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToBuyerForNewOfferMade extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $buyer;
    protected $seller;
    protected $venture;
    public $subject;

    public function __construct($buyer =null, $seller= null, $venture = null, $subject = null)
    {
        $this->buyer = $buyer;
        $this->seller = $seller;
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
        $listing = $this->venture;
        $sub = "Your offer on Venture Listing ID $listing->list_automated_id";
        return $this->view('email.current_ventures.offers.sendEmailToBuyerForNewOfferMade')->with(['user' => $this->buyer, 'venture' => $this->venture])->subject($sub);
    }
}
