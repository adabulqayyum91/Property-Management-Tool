<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;
    protected $table = 'plans';
    protected $fillable = ['name','price','description', 'plan_type'];
    public function logs()
    {
        return $this->morphMany('App\Models\Log', 'logable');
    }
}
