<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVentureListingEmails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    public $subject;
    public $view;
    protected $venture;
    protected $document_hash;
    protected $ownershipPercentage;

    public function __construct($user = null, $subject = null, $view = null, $venture = null, $document_hash = null,$ownershipPercentage)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->view = $view;
        $this->venture = $venture;
        $this->document_hash = $document_hash;
        $this->ownershipPercentage = $ownershipPercentage;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view, [
            'user' => $this->user,
            'venture' => $this->venture,
            'document_hash' => $this->document_hash,
            'ownershipPercentage' => $this->ownershipPercentage,
        ])->subject($this->subject);
    }
}
