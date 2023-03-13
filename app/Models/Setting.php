<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    protected $fillable = ['label','status'];


    const PRICE_SECTION_ID = 1;
}
