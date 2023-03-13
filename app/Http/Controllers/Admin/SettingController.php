<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;


class SettingController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePriceSectionStatus(Request $request)
    {
        try{
            $priceSectionId = Setting::PRICE_SECTION_ID;
            $priceSection = Setting::find($priceSectionId);
            
            if (is_null($priceSection)) {
                return response()->json([
                    'status' => false,
                    'message' => "Following setting does not exist"
                ],400);
            }
            $priceSection= Setting::where('id',$priceSectionId)->update([
                            'status' => $request->status,
                        ]);

            return response()->json([
                    'status' => true,
                    'message' => 'Status was updated successfully!'
                ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
