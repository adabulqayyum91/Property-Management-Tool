<?php

namespace App\Exports;

use App\Models\Offer;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Config;

class ExportOffers implements FromCollection, Responsable, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

	private $fileName = "Offers.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Offer::all();
    }

    /**
     * @return array
     */
    public function map($offer):array
    {
    	return [
    		$offer->venture_listing->list_automated_id,
            $offer->venture_listing->venture->venture_name,
            $offer->user->member_automated_id,
            $offer->venture_listing->users()->first()->member_automated_id,            
            $offer->amount,
            $offer->seller_ownership,
            $offer->created_at
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
            "Offer Amount",
            "Offer Seller Ownership",
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
