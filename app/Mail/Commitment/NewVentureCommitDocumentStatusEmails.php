<?php

namespace App\Mail\Commitment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewVentureCommitDocumentStatusEmails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    protected $type;
    protected $document_hash;
    protected $venture;
    public $subject;

    public function __construct($user = null, $type = null, $document_hash = null, $venture = null, $subject = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->document_hash = $document_hash;
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
        if(!is_null($this->type)){
            return $this->subject(!is_null($this->subject) ? $this->subject : '')->view('email.new_ventures.commit.document-'.$this->type)->with(['user' => $this->user, 'document_hash' => $this->document_hash, 'venture' => $this->venture]);
        }

    }
}