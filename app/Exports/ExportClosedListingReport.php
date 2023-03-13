<?php
namespace App\Exports;

use App\Models\VentureListing;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\FromView;

class ExportClosedListingReport implements FromView
{

    public function view(): View
    {
        $currentMonth = date('m');
        $ventureListing = VentureListing::where('type','CURRENT')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('status', Config::get('constants.VENTURE_BUY_NOW_STATUS')[3])->get();
        return view('exports.ExportClosedListingReport', [
            'data' => $ventureListing
        ]);
    }
}