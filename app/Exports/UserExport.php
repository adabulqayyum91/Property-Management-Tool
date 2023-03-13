<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExport implements FromCollection, Responsable, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
	use Exportable;

	private $fileName = "users.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
     * @return array
     */
    public function map($user):array
    {
    	return [
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->date_of_birth,
            $user->phone,
            $user->street,
            $user->city,
            $user->state,
            $user->zip,
    	];
    }

    /**
     * @return array
     */
    public function headings():array
    {
    	return [
    		"First Name",
            "Last Name",
            "Email",
            "Date Of Birth",
            "Phone",
            "Street",
            "City",
            "State",
            "Zip"
    	];
    }

    /**
     * @return array
     */
    public function registerEvents():array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
            	$event->sheet->getStyle('A1:I1')->applyFromArray([
            		'font'=>[
            			'bold'=>true,
            		],
            	]);
            },
        ];
    }
}