<?php

namespace App\Exports;

use App\Models\VentureListing;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;

class NewVentureListing implements FromCollection, Responsable, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

	private $fileName = "new-venture-listing.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VentureListing::where('type','NEW')->get();
    }

    /**
     * @return array
     */
    public function map($newVentureListing):array
    {   
        $state = '';
        if($newVentureListing->venture->state)
        {
            $state = $newVentureListing->venture->state["name"];
        }        
    	return [
            $newVentureListing->list_automated_id,
            $newVentureListing->type,
            $newVentureListing->list_status,
            $newVentureListing->created_at,            
            $newVentureListing->venture->venture_name,
            $newVentureListing->venture->venture_automated_id,
            $newVentureListing->venture->target_amount,
            $newVentureListing->cap_rate,
            $newVentureListing->venture->ventureDetail["property_street"],
            $newVentureListing->venture->ventureDetail["property_city"],
            $state,
            $newVentureListing->venture->ventureDetail["property_zip"],      
            $newVentureListing->venture->ventureDetail["created_at"],               
    	];
    }

    /**
     * @return array
     */
    public function headings():array
    {
    	return [
            "Listing ID",
            "Venture Type",
            "Listing Status",
            "Date Fund By",            
            "Venture Name",
            "Venture ID",                        
            "Target Amount",
            "Cap Rate",
            "Property Street",
            "Property City",
            "Property State",
            "Property Zip",
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
            	$event->sheet->getStyle('A1:M1')->applyFromArray([
            		'font'=>[
            			'bold'=>true,
            		],
            	]);
            },
        ];
    }
}
