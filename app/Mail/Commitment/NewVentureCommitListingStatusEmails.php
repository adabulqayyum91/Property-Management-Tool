<?php

namespace App\Mail\Commitment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVentureCommitListingStatusEmails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $type;

    public function __construct($user = null, $type = null)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!is_null($this->type)){
            return $this->view('email.new_ventures.commit.document-'.$this->type)->with(['user' => $this->user]);
        }

    }
}