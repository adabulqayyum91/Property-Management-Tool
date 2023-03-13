<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Survey extends Model
{
    protected $table = 'surveys';
    protected $fillable = ['subject','body','user_id','venture_id','due_date','result_sent'];

    public function venture()
    {
        return $this->hasOne('App\Models\Venture','id','venture_id');
    }

    public function medias()
    {
        return $this->morphMany('App\Models\Media', 'mediaable');
    }


    public static function result()
    {
    	$now = Carbon::now()->format('Y-m-d H:i');
    	$surveys = self::where('result_sent',0)
       ->where('due_date','<',$now)
       ->get();

       foreach ($surveys as $key => $survey)
       {
          $user_ids   = VentureOwnership::where('venture_id',$survey->venture_id)
          ->where('isDeleted',0)
          ->pluck('user_id');
          $emails     = User::whereIn('id',$user_ids)->pluck('email')->toArray();
          $venture    = Venture::where('id',$survey->venture_id)->first();

          if(!empty($venture))
          {
             $questions = SurveyQuestion::where('survey_id',$survey->id)->get();

             \Mail::send('email.surveyResultEmail',["survey"=>$survey,"questions"=>$questions,"venture"=>$venture], function ($message) use ($emails) {
                 $message->from('contact@gmail.com', 'Survey Result Email');
                 $message->to($emails)->subject('Survey Result Email');
             });

         }
         $survey->update(["result_sent"=>1]);
     }
 }
}
