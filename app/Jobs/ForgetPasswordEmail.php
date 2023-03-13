<?php

namespace App\Jobs;

use App\Mail\ForgetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user, $email, $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$email,$data)
    {
        $this->user = $user;
        $this->email = $email;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         $email = new ForgetPassword($this->user, $this->email, $this->data);
        \Mail::to($this->user['email'])->send($email);
    }
}
