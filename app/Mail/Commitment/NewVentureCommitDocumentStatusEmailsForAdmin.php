<?php

namespace App\Mail\Commitment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVentureCommitDocumentStatusEmailsForAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $type;
    protected $venture;

    public function __construct($user = null, $type = null, $venture = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->venture = $venture;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!is_null($this->type)){
            return $this->subject('Venture '.$this->venture->list_automated_id)->view('email.new_ventures.commit.admin-document-'.$this->type)->with(['user' => $this->user, 'venture' => $this->venture]);
        }

    }
}
