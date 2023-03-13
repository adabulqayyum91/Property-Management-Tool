<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 4/3/2020
 * Time: 12:19 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPlan extends Model
{
    use SoftDeletes;
    protected $table = 'user_plan';
    protected $fillable = ['stripe_plan_id','plan_id','user_id'];
}