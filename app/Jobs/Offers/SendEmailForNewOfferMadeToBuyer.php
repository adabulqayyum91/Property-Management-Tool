<?php

namespace App\Jobs\Offers;

use App\Mail\Offers\SendEmailToBuyerForNewOfferMade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailForNewOfferMadeToBuyer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $venture;
    public $subject;
    public $offer;


    public function __construct($user =null, $venture = null, $subject = null, $offer = null)
    {
        $this->user = $user;
        $this->venture = $venture;
        $this->subject = $subject;
        $this->offer = $offer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendEmailToBuyerForNewOfferMade($this->user, $this->venture, $this->subject, $this->offer);
        Mail::to($this->user->email)->send($email);
    }
}
