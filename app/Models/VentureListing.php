<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/9/2020
 * Time: 1:08 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VentureListing extends Model
{
    use SoftDeletes;
    protected $table = 'lists_venture';

    protected $guarded = [''];

    public CONST TYPE_NEW = "NEW";
    public CONST TYPE_CURRENT = "CURRENT";


    public function medias()
    {
        return $this->morphMany('App\Models\Media', 'mediaable');
    }
    public function venture()
    {
        return $this->belongsTo('App\Models\Venture');
    }
    public function commits()
    {
        return $this->hasMany('App\Models\VentureCommit','new_venture_listing_id');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User','users_venture_listings');
    }
    public function logs()
    {
        return $this->morphMany('App\Models\Log', 'logable');
    }
    public function BuyNow()
    {
        return $this->hasOne('App\Models\BuyNow','venture_listing_id');
    }
    public function offers()
    {
        return $this->hasMany('App\Models\Offer','venture_listing_id');
    }
    public function sellingListings()
    {
        return $this->belongsToMany('App\Models\VentureListing','user_venture_listing_selling','venture_listing_id','user_id')->withPivot('price','description','ownership_percent');
    }

    // Declare event handlers FOR delete all relations
    public static function boot() {
        parent::boot();
        static::deleting(function($model) { // before delete() method call this
            try {
                //****Delete comment****
                $model->commits()->each(function ($comment) {
                    $comment->delete();
                });
                //****Delete Offer****
                $model->offers()->each(function ($offer) {
                    $offer->delete();
                });
                //****Delete Buy now****
                $model->BuyNow()->each(function ($buyNow) {
                    $buyNow->delete();
                });
            }catch (\Exception $e){
            }
            });
    }
}
