<?php
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 3/9/2020
 * Time: 10:06 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $table = 'user_requests';

    protected $fillable = [
        'name', 'email','first_name','last_name','about_us_source',
        'phone','manage_income_property','interest','contact_timing'
    ];

}