<?php

namespace App\Jobs\Offers;

use App\Mail\Offers\SendEmailToSellerForNewOfferMade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForNewOfferMadeToSeller implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendEmailToSellerForNewOfferMade($this->user, $this->venture, $this->subject);
        if(!is_null($this->user)) {
            Mail::to($this->user->email)->send($email);
        }
    }
}
