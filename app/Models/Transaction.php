<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['label','venture_id','user_id','note','date_time','value','ownership_id','type'];


    public function venture()
    {
        return $this->hasOne('App\Models\Venture','id','venture_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

}
