<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = ['code','name'];

    public function cities()
    {
        return $this->hasMany('App\City', 'state_id');
    }

    public function ventureDetail(){
    return $this->hasOne('App\Models\VentureDetail','property_state');

    }

    public function venture()
    {
        return $this->belongsTo('App\Models\Venture');
    }
}
