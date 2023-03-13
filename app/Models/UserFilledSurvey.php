<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFilledSurvey extends Model
{
    protected $table = 'user_filled_surveys';
    protected $fillable = ['user_id','survey_id'];

    public function survey()
    {
        return $this->hasOne('App\Models\Survey','id','survey_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
