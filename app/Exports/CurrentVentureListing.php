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

class CurrentVentureListing implements FromCollection, Responsable, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;

	private $fileName = "current-venture-listing.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VentureListing::where('type','CURRENT')->get();
    }

    /**
     * @return array
     */
    public function map($CurrentVentureListing):array
    {
        $user = $CurrentVentureListing->users->first();
        $state = '';
        $memberId = '';
        $username = '';
        if($user && $user["member_automated_id"])
        {
            $memberId = $user["member_automated_id"];
        }
        if($user && $user["name"])
        {
            $username = $user["name"];
        }
        if($CurrentVentureListing->venture->state)
        {
            $state = $CurrentVentureListing->venture->state["name"];
        } 
    	return [
            $CurrentVentureListing->list_automated_id,
            $memberId,
            $username,
            $CurrentVentureListing->type,
            $CurrentVentureListing->venture->venture_automated_id,
            $CurrentVentureListing->venture->venture_name,
            $CurrentVentureListing->cap_rate,
            $CurrentVentureListing->list_status,            
            $CurrentVentureListing->asking_price,
            $CurrentVentureListing->percentage_of_ownership,                        
            $CurrentVentureListing->venture->ventureDetail["property_street"],
            $CurrentVentureListing->venture->ventureDetail["property_city"],
            $state,
            $CurrentVentureListing->venture->ventureDetail["property_zip"],
    	];
    }

    /**
     * @return array
     */
    public function headings():array
    {
    	return [
            "Listing ID",
            "Member ID",
            "User Name",
            "Venture Type",
            "Venture ID",  
            "Venture Name",
            "Cap Rate",
            "Listing Status",
            "Asking Price",
            "% of Owner's Holdings",
            "Property Street",
            "Property City",
            "Property State",
            "Property Zip",                		
    	];
    }

    /**
     * @return array
     */
    public function registerEvents():array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
            	$event->sheet->getStyle('A1:N1')->applyFromArray([
            		'font'=>[
            			'bold'=>true,
            		],
            	]);
            },
        ];
    }
}
