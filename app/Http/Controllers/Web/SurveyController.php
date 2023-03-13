<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\UserFilledSurvey;
use App\Models\SurveyQuestion;
use App\Models\QuestionOption;
use App\Models\PickedOption;
use App\Models\VentureOwnership;
use App\Models\VentureManager;
use App\Models\Venture;
use App\Models\User;
use App\Helpers\Helper;

use Auth;
use Carbon\Carbon;

class SurveyController extends Controller
{
    public function index()
    {
        $surveyIds = UserFilledSurvey::where('user_id',auth()->user()->id)->pluck('survey_id');
        $now = Carbon::now()->format('Y-m-d H:i');
        $ventureIds = VentureOwnership::where('user_id',auth()->user()->id)->where('isDeleted',0)->pluck('venture_id');
    	$surveys = Survey::whereIn('venture_id',$ventureIds)
                        ->whereNotIn('id',$surveyIds)
                        ->where('due_date','>=',$now)
                        ->has('venture')
                        ->latest()->paginate(5);
        return view('web.survey.index',compact('surveys'));
    }

    public function show($surveyId)
    {
        $ventureIds = VentureOwnership::where('user_id',auth()->user()->id)->where('isDeleted',0)->pluck('venture_id');
        $survey = Survey::where('id',$surveyId)->first();
        $questions = SurveyQuestion::where('survey_id',$surveyId)->with('options')->get();
    	return view('web.survey.show',compact('survey','questions'));
    }
    public function store(Request $request)
    {
        try{

            $survey = Survey::findorfail($request->survey_id);
            
            if(Carbon::parse($survey->due_date)->isPast())
            {
                return redirect()->back()->with('danger','Date to submit the survey is closed');
            }

            $totalQuestions = SurveyQuestion::where('survey_id',$request->survey_id)->count();

            $userId = auth()->user()->id;
            // $options = $request->pickedOption;
            
            $pickedOptionsObj = [];
            for($i=0;$i<$totalQuestions;$i++)
            {
                $pickedOptionsObj[]=[
                                    "option_id"=>$request["pickedOption".($i+1)],
                                    "user_id"=>$userId
                                ];
            }
            $pickedOptions = PickedOption::insert($pickedOptionsObj);
            
            $userFilledSurvey = UserFilledSurvey::create([
                                                    "survey_id"=>$request->survey_id,
                                                    "user_id"=>$userId
                                                ]);

            return redirect('/survey')->with('success','Survey Submitted Successfully');

        } 
        catch (\Exception $e) 
        {
            dd($e);
            return redirect('/')->with('danger','Something went wrong! Please try again later.');
        }
    }

    public function surveySearch(Request $request)
    {
        try{
            $surveys = Helper::surveySearchUser($request->all());
            $view = (string)view('web.survey.search_table_row',compact('surveys'));
            return response()->json([
                'view' => $view,
                'status' => true,
                'message' => 'Survey data successfully updated!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
