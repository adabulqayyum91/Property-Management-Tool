<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function venture()
    {
        return $this->belongsTo('App\Models\venture','type_id')->where('type','Listing');
    }
}
