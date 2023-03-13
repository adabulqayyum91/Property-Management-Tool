<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralUser extends Model
{
    use SoftDeletes;
    protected $table = 'follow_up_users';
    protected $fillable = ['name','email','phone','contact_source','description','status','user_id'];

    public function logs()
    {
        return $this->morphMany('App\Models\Log', 'logable');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
