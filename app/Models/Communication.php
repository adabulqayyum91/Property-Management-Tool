<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $table = 'communications';
    protected $fillable = ['venture_id','to_user','from_user','subject','body','read_status'];


    public function toUser()
    {
        return $this->hasOne('App\Models\User','id','to_user');
    }

    public function fromUser()
    {
        return $this->hasOne('App\Models\User','id','from_user');
    }

    public function venture()
    {
        return $this->hasOne('App\Models\Venture','id','venture_id');
    }
}
