<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class VentureDetail extends Model
{
    protected $table = 'venture_details';

    protected $guarded = [''];

    public function venture()
    {
        return $this->belongsTo('App\Models\Venture');
    }
    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
