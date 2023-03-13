<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $table = 'survey_questions';
    protected $fillable = ['survey_id','question'];

    public function options()
    {
        return $this->hasMany('App\Models\QuestionOption','question_id','id');
    }
}
