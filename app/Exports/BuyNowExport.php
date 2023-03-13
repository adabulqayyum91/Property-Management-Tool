<?php

namespace App\Exports;

use App\Models\BuyNow;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Config;

class BuyNowExport implements FromCollection, Responsable, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
	use Exportable;

	private $fileName = "BuyNow.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BuyNow::where('status','Closing')->get();
    }

    /**
     * @return array
     */
    public function map($buyNow):array
    {
    	return [
    		$buyNow->venture_listing->list_automated_id,
            $buyNow->venture_listing->venture->venture_name,
            $buyNow->user->member_automated_id,
            $buyNow->venture_listing->users()->first()->member_automated_id,            
            $buyNow->venture_listing->asking_price,
            $buyNow->venture_listing->percentage_of_ownership,
            $buyNow->created_at
    	];
    }

    /**
     * @return array
     */
    public function headings():array
    {
    	return [
            "Listing ID",
            "Venture Name",            
            "Buyer ID",
            "Seller ID",
            "Amount",
            "% Ownership",
            "Date Listed",    		
    	];
    }

    /**
     * @return array
     */
    public function registerEvents():array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
            	$event->sheet->getStyle('A1:F1')->applyFromArray([
            		'font'=>[
            			'bold'=>true,
            		],
            	]);
            },
        ];
    }
}
