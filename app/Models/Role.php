<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/6/2020
 * Time: 12:24 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

    protected $table = 'roles';
    protected $fillable = ['name', 'slug','description','level'];

    CONST USER = 2;
    public function userRole()
    {
        return $this->belongsTo('App\Models\UserRole','role_id');
    }
}
