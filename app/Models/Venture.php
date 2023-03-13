<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Venture extends Model
{
    use SoftDeletes;
    protected $table = 'ventures';
    protected $guarded = [''];
    protected $fillable = ['venture_automated_id','venture_status','venture_type','venture_source_type'
    ,'venture_name','date_of_incorporation','date_of_Purchase','purchase_price','initial_cap','staff_manager'
    ,'managing_member','venture_street','venture_city','venture_state','venture_zip','target_amount','property_manager'];

    public function medias()
    {
        return $this->morphMany('App\Models\Media', 'mediaable');
    }
    public function logs()
    {
        return $this->morphMany('App\Models\Log', 'logable');
    }
    public function ventureDetail()
    {
        return $this->hasOne('App\Models\VentureDetail','venture_id');
    }
    public function ventureList()
    {
        return $this->hasMany('App\Models\VentureListing','venture_id');
    }
    /*public function status()
    {
        return $this->hasOne('App\Models\status');
    }
    public function type()
    {
        return $this->hasOne('App\Models\type');
    }*/
    public function state()
    {
        return $this->hasOne('App\State','id','venture_state');
    }

    //*****check if venture_id already exist in New Venture listing
    public function VentureExist(){
        $status=false;
        $newVenture= VentureListing::where('venture_id','=',$this->id)->first();
        if($newVenture){
            $status=true;
        }

        return $status;
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User','users_venture_listings','user_id');
    }

    //  Declare event handlers FOR delete all relations
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($model) { // before delete() method call this
            try {
                //****Delete Venture List****
                $model->ventureList()->each(function ($ventureList) {
                    $ventureList->delete();
                });
            } catch (\Exception $e) {
            }
        });
    }
}
