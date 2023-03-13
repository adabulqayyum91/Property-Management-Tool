<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/9/2020
 * Time: 1:08 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SellingOwnershipVentureListing extends Model
{
    protected $table = 'user_venture_listing_selling';

    protected $guarded = [''];

    public function venture()
    {
        return $this->belongsTo('App\Models\Venture');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ventureListing()
    {
        return $this->belongsTo('App\Models\VentureListing','venture_listing_id');
    }
}
