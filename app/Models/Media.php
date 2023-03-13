<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $guarded = [''];
    protected $table = 'medias';


    public function mediaable()
    {
        return $this->morphTo();
    }
}
