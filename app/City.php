<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['state_id','name'];


    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

}
