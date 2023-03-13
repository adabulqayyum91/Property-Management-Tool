<?php

namespace App\Jobs\Commitment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class NewVentureCommitListingStatusEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $type;


    public function __construct($user =null, $type= null)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!is_null($this->user) && !is_null($this->type)){
            $email = new \App\Mail\Commitment\NewVentureCommitListingStatusEmails($this->user, $this->type);
            Mail::to($this->user->email)->send($email);
        }
    }
}
