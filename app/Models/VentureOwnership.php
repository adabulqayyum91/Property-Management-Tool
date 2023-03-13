<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentureOwnership extends Model
{
    protected $table = 'venture_ownerships';

    protected $fillable = ['venture_id','user_id','ownership_sequence_start','ownership_sequence_end','amount_paid','amount_sold','ownership_begin_date','ownership_end_date','isDeleted','deleted_at'];

    public function venture()
    {
        return $this->hasOne('App\Models\Venture','id','venture_id');
    }

    public function ventureListing()
    {
        return $this->hasOne('App\Models\VentureListing','venture_id','venture_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
