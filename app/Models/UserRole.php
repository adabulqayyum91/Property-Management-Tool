<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table = 'role_user';
    protected $fillable = ['role_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function role()
    {
        return $this->hasOne('App\Models\Role','id','role_id');
    }
}
