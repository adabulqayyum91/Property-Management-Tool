<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Imports
use App\Imports\OwnershipImport;
use App\Imports\VentureRentalImport;

// Models
use App\Models\Venture;
use App\Models\User;
use App\Models\VentureRental;
use App\Models\VentureOwnership;

// Helper
use App\Helpers\Helper;
use App\Helpers\Message;

// Excel
use Excel;

class ImportController extends Controller
{
	public function ownershipImportPage()
    {
    	return view('admin.layouts.pages.imports.index');
    }
    public function importOwnership(Request $request)
    {
    	try
        {
        	
            $file = $request->file('excelFile')->store('import');
            $sheet = Excel::toArray(new OwnershipImport, $file);
            $data = $sheet[Helper::FIRST_SHEET];


            $errors  = [];
            $records = [];
            $errorFieldStatus = false;

            foreach ($data as $key => $d) 
            {
                $errorFieldStatus = false;
                $recordNo = $key+1;

                if(is_null($d['venture_id']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Venture ID",Message::FIELD_REQUIRED);
                }
                else
                {
                    $venture = Venture::where('venture_automated_id',$d['venture_id'])
                    ->where('deleted_at',null)
                    ->first();
                    if(empty($venture))
                    {
                        $errorFieldStatus   = true;
                        $errors[] = Helper::errorObject($recordNo,"Venture ID",Message::VALUE_INVALID,$d['venture_id']);
                    }
                }

                if(is_null($d['member_id']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Member ID",Message::FIELD_REQUIRED);
                }
                else
                {
                    $user = User::where('member_automated_id',$d['member_id'])
                    ->where('deleted_at',null)
                    ->first();
                    if(empty($user))
                    {
                        $errorFieldStatus   = true;
                        $errors[] = Helper::errorObject($recordNo,"Member ID",Message::VALUE_INVALID,$d['member_id']);
                    }
                }

                if(is_null($d['ownership_sequence']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Ownership Sequence",Message::FIELD_REQUIRED);
                }
                else
                {
                    $d['ownership_sequence'] = explode(':', $d['ownership_sequence']);
                }

                if(is_null($d['amount_paid']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Amount Paid",Message::FIELD_REQUIRED);
                }

                // TODO: This will be used in future
                // if(is_null($d['amount_sold']))
                // {
                //     $errorFieldStatus   = true;
                //     $errors[] = Helper::errorObject($recordNo,"Amount Sold is required");
                // }


                if(is_null($d['ownership_begin_date']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Ownership Begin Date",Message::FIELD_REQUIRED);
                }
                else
                {
                	$d['ownership_begin_date'] =  \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($d['ownership_begin_date']))->format('m/d/y');
                }

                if(!is_null($d['ownership_end_date']))
                {
                    $d['ownership_end_date'] =  \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($d['ownership_end_date']))->format('m/d/y');
                }


                if(!$errorFieldStatus)
                {
                    $limits = [
                        $d['ownership_sequence'][Helper::OWNERSHIP_START_INDEX],
                        $d['ownership_sequence'][Helper::OWNERSHIP_END_INDEX]
                    ];
                    $existedSequenceCount = VentureOwnership::where('venture_id',$venture->id)
                    ->where(function ($query) use ($limits){
                        $query->whereBetween('ownership_sequence_start',$limits)
                        ->orWhereBetween('ownership_sequence_end',$limits);
                    })
                    ->where('isDeleted',0)
                    ->count();
                    if($existedSequenceCount>0)
                    {
                        $errorFieldStatus   = true;
                        $errors[] = Helper::errorObject($recordNo,"Ownership Sequence",Helper::SEQUENCE_CLASHED,implode(':',$d['ownership_sequence']));
                    }
                }

                

                if(!$errorFieldStatus)
                {

                    $record = [
                        "user_id" => $user->id,
                        "venture_id" => $venture->id,
                        "ownership_sequence_start"=>$d['ownership_sequence'][Helper::OWNERSHIP_START_INDEX],
                        "ownership_sequence_end"=>$d['ownership_sequence'][Helper::OWNERSHIP_END_INDEX],
                        "amount_paid" => $d['amount_paid'],
                        "amount_sold" => is_null($d['amount_sold'])?0:$d['amount_paid'],
                        "ownership_begin_date" => $d['ownership_begin_date'],
                        "ownership_end_date" => $d['ownership_end_date'],
                    ];
                    $ventureOwnership = VentureOwnership::create($record);
                }
            } 

            // TODO: This code will not cause error. It is for future use.
            // if(count($records)>0)
            // {
            //     $insert = VentureOwnership::insert($records);
            // }
            
            if(count($errors)>0)
            {
                return back()->withFailures($errors);
            }
            return back()->with(Message::FLASH_SUCCESS,Message::IMPORT_SUCCESS);
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function ventureRentalImportPage()
    {
        return view('admin.layouts.pages.imports.ventureRental');
    }
    public function importVentureRental(Request $request)
    {
        try
        {

            $file = $request->file('excelFile')->store('import');
            $sheet = Excel::toArray(new VentureRentalImport, $file);
            $data = $sheet[Helper::FIRST_SHEET];


            $errors  = [];
            $records = [];
            $errorFieldStatus = false;

            foreach ($data as $key => $d) 
            {
                $errorFieldStatus = false;
                $recordNo = $key+1;

                if(is_null($d['venture_id']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Venture ID",Message::FIELD_REQUIRED);
                }
                else
                {
                    $venture = Venture::where('venture_automated_id',$d['venture_id'])
                    ->where('deleted_at',null)
                    ->first();
                    if(empty($venture))
                    {
                        $errorFieldStatus   = true;
                        $errors[] = Helper::errorObject($recordNo,"Venture ID",Message::VALUE_INVALID,$d['venture_id']);
                    }
                }

                if(is_null($d['rent_due']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Rent Due",Message::FIELD_REQUIRED);
                }

                if(is_null($d['amount_collected']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Amount Collected",Message::FIELD_REQUIRED);
                }

                if(is_null($d['fees_and_other_income']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Fees and Other Income",Message::FIELD_REQUIRED);
                }

                if(is_null($d['management_fee']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Management Fee",Message::FIELD_REQUIRED);
                }

                if(is_null($d['repairs_and_other_expenses']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Repair and Other Expenses",Message::FIELD_REQUIRED);
                }

                if(is_null($d['rent_past_due']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Rent Past Due",Message::FIELD_REQUIRED);
                }

                if(is_null($d['date_rent_collected']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Date Rent Collected",Message::FIELD_REQUIRED);
                }
                else
                {
                    $d['date_rent_collected'] =  \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($d['date_rent_collected']))->format('Y-m-d');
                }

                if(is_null($d['net_income']))
                {
                    $errorFieldStatus   = true;
                    $errors[] = Helper::errorObject($recordNo,"Net Income",Message::FIELD_REQUIRED);
                }


                if(!$errorFieldStatus)
                {
                    $ventureRental = VentureRental::where('venture_id',$venture->id)
                    ->where('date_rent_collected',$d['date_rent_collected'])
                    ->first();
                    if(empty($ventureRental))
                    {
                        $records[] = [
                            "venture_id" => $venture->id,
                            "date_rent_collected"=>$d['date_rent_collected'],
                            "rent_due" => Helper::ifNullReturnZero($d['rent_due']),
                            "amount_collected" => Helper::ifNullReturnZero($d['amount_collected']),
                            "rent_past_due" => Helper::ifNullReturnZero($d['rent_past_due']),
                            "fees_and_other_income" => Helper::ifNullReturnZero($d['fees_and_other_income']),
                            "management_fee" => Helper::ifNullReturnZero($d['management_fee']),
                            "repairs_and_other_expenses" => Helper::ifNullReturnZero($d['repairs_and_other_expenses']),
                            "net_income" => Helper::ifNullReturnZero($d['net_income']),
                        ];
                    }
                    else
                    {
                        $errorFieldStatus   = true;
                        $errors[] = Helper::errorObject($recordNo,"Date Rent Collected",Message::ALREADY_EXIST);
                    }
                }
            } 

            if(count($records)>0)
            {
                $insert = VentureRental::insert($records);
            }
            
            if(count($errors)>0)
            {
                return back()->withFailures($errors);
            }
            return back()->with(Message::FLASH_SUCCESS,Message::IMPORT_SUCCESS);
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
