<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class VentureManager extends Model
{

    protected $table = 'venture_managers';
    protected $fillable = ['venture_id', 'user_id'];

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
