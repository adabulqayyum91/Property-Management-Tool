<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referrals';
    protected $fillable = ['user_id','status_id','first_name','last_name',
        'phone','email','referred_by_name','referred_by_id'];


    public function statuses()
    {
        return $this->belongsTo('App\Models\status', 'status_id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function follows()
    {
        return $this->hasMany('App\Follow', 'referral_id');
    }
}
