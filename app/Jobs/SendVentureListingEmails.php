<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SendVentureListingEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user;
    public $subject;
    public $view;
    protected $venture;
    protected $document_hash;
    protected $ownershipPercentage;

    public function __construct($user = null, $subject = null, $view = null, $venture = null, $document_hash = null, $ownershipPercentage = null)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->view = $view;
        $this->venture = $venture;
        $this->document_hash = $document_hash;
        $this->ownershipPercentage = $ownershipPercentage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new \App\Mail\SendVentureListingEmails($this->user, $this->subject, $this->view, $this->venture, $this->document_hash, $this->ownershipPercentage);
        Mail::to(gettype($this->user) == 'string' ? Config::get('constants.ADMIN_EMAIL') :$this->user->email)->send($email);

    }
}
