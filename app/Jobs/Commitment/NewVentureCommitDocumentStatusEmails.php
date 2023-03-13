<?php

namespace App\Jobs\Commitment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class NewVentureCommitDocumentStatusEmails implements ShouldQueue
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


    public function __construct($user =null, $type= null, $venture = null, $document_hash = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->venture = $venture;
        $this->document_hash = $document_hash;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!is_null($this->user) && !is_null($this->type)){
            $email = new \App\Mail\Commitment\NewVentureCommitDocumentStatusEmails($this->user, $this->type, $this->document_hash);
            Mail::to($this->user->email)->send($email);

            $email = new \App\Mail\Commitment\NewVentureCommitDocumentStatusEmailsForAdmin($this->user, $this->type, $this->venture);
            Mail::to(Config::get('constants.ADMIN_EMAIL'))->send($email);
        }
    }
}
