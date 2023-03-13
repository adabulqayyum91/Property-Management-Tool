<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickedOption extends Model
{
    protected $table = 'picked_options';
    protected $fillable = ['option_id','user_id'];
}
