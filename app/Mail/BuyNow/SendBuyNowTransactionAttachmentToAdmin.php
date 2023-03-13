<?php

namespace App\Mail\BuyNow;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBuyNowTransactionAttachmentToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $path;

    public function __construct($path = null){
        $this->path = $path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.reports.BuyNowTransactionsMonthlyReportForAdmin', ['path' => $this->path])->subject('Buy Now Transaction Report With Attachments!');

//            ->attach($this->path, [
//            'as' => 'BuyNow Transaction Report.xlsx',
//            'mime' => 'application/xlsx',
//        ])
    }
}