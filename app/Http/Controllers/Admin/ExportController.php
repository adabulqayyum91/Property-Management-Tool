<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Exports
use App\Exports\UserExport;
use App\Exports\NewVentureListing;
use App\Exports\CurrentVentureListing;
use App\Exports\ExportOffers;
use App\Exports\BuyNowExport;

class ExportController extends Controller
{
    public function exportUsers()
    {
    	return new UserExport;
    }

    // Other Export API's
    
    public function exportNewVentureListing()
    {
    	return new NewVentureListing;
    }

    public function exportCurrentVentureListing()
    {
    	return new CurrentVentureListing;
    }

    public function exportOffers()
    {
    	return new ExportOffers;
    }

    public function exportByNow()
    {
        return new BuyNowExport;
    }

    // public function exportUsers()
    // {
    // 	return new UserExport;
    // }
}
