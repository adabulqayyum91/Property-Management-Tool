<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyNow extends Model
{
    use SoftDeletes;
    protected $guarded = [''];
    protected $table = 'buy_now_listing';


    public function venture_listing()
    {
        return $this->belongsTo('App\Models\VentureListing','venture_listing_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
