<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VentureCommit extends Model
{
    use SoftDeletes;
    protected $table = 'new_venture_commits';
    protected $fillable = ['new_venture_listing_id','user_id','amount','status','document_hash','unitStart','unitEnd'];

    public function NewVentureListing()
    {
        return $this->belongsTo('App\Models\VentureListing','new_venture_listing_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
