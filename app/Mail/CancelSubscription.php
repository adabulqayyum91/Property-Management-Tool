<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelSubscription extends Mailable
{
    use Queueable, SerializesModels;
  public $user;
  public $reason_leaving;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $reason)
    {
        $this->user = $user;
        $this->reason_leaving = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('email.cancelSubscription',[
             'user' => $this->user,
             'reason' => $this->reason_leaving
         ]);
    }
}
