<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';
    protected $fillable = ['referral_id','date_referral_first_contact','date_last_Contact','date_next_follow','comment'];

    public function referrals()
    {
        return $this->belongsTo('App\Referral', 'referral_id');
    }
}
