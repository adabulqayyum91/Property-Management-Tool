<?php

namespace App\Jobs\Offers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class CurrentVentureOfferFundingStatusEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $venture;
    public $subject;


    public function __construct($venture = null, $subject = null)
    {
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
        $email = new \App\Mail\Offers\CurrentVentureOfferFundingStatusEmails($this->venture, $this->subject);
        Mail::to(Config::get('constants.ADMIN_EMAIL'))->send($email);
    }
}
