<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    public function venture()
    {
        return $this->belongsTo('App\Models\venture','status_id')->where('type','Listing');
    }
    public function users()
    {
        return $this->hasMany('App\Models\User','status');
    }

    public function referral()
    {
        return $this->hasMany('App\Referral','status_id');
    }
}
