<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Offer extends Model
{
    use SoftDeletes;
    protected $guarded = [''];
    protected $table = 'offers';


    public function venture_listing()
    {
        return $this->belongsTo('App\Models\VentureListing','venture_listing_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public static function expire()
    {
        $now = Carbon::now();
        $offers = self::where('status','New Offer')
                        ->get();

        foreach ($offers as $key => $offer) 
        {

            $created_at = Carbon::parse($offer->created_at);

            if($created_at->diffInHours($now)>=48)
            {
                $offer->update(["status"=>'Declined']);
            }
        }
    }
}
