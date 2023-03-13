<?php

namespace App\Jobs\Offers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class CurrentVentureOfferDocumentStatusEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $type;
    protected $venture;
    protected $document_hash;
    public $subject;
    protected $to;
    protected $send_to_admin;


    public function __construct($user =null, $type= null, $venture = null, $document_hash = null, $subject = null, $to = null, $send_to_admin = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->venture = $venture;
        $this->document_hash = $document_hash;
        $this->subject = $subject;
        $this->to = $to;
        $this->send_to_admin = $send_to_admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!is_null($this->user) && !is_null($this->type)){
            $email = new \App\Mail\Offers\CurrentVentureOfferDocumentStatusEmails($this->user, $this->type, $this->document_hash, $this->venture, $this->subject);
            Mail::to(!is_null($this->to) ? $this->to : $this->user->email)->send($email);
        }

        if($this->send_to_admin == 'true'){
            $email = new \App\Mail\Offers\CurrentVentureBuyNowDocumentStatusEmailsForAdmin($this->user, $this->type, $this->venture);
            Mail::to(Config::get('constants.ADMIN_EMAIL'))->send($email);
        }
    }
}
