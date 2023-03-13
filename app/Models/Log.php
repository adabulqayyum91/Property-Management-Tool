<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = ['title','description','logable_type'];
    use SoftDeletes;

    public function logable()
    {
        return $this->morphTo();
    }
}
