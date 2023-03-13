<?php

namespace App\Console\Commands;

use App\Exports\ExportClosedListingReport;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class BuyNowTransactionMonthlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buynowtransactionmonthly:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will create a pdf end of the month of all transactions of BuyNow which are in closing status.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            Log::info("Buy Now Transactions Cron is working fine!");
            //Get All Buy Now Transaction which are in closing status
            $filename = date('d-m-Y-h-iA').'-BuyNowTransactionReport.xlsx';
            $path = 'exports/'.$filename;
            Excel::store(new ExportClosedListingReport, $path);
            // Transferring File to $path

            // Sending Email to admin with attachment
            $emailJob = (new \App\Jobs\BuyNow\SendBuyNowTransactionAttachmentToAdmin(storage_path($path)))->delay(Carbon::now()->addSecond(1));
            dispatch($emailJob);

            Log::info("Buy Now Transactions report successfully send to admin email!");
        }catch (\Exception $exception){
            Log::error("Something went wrong While Buy Now Transactions Cron is generating report and sending email!");
        }
    }
}
