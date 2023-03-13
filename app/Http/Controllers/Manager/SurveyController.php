<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\QuestionOption;
use App\Models\PickedOption;
use App\Models\VentureOwnership;
use App\Models\VentureManager;
use App\Models\Venture;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Media;

use Illuminate\Support\Facades\Config;


use Auth;
use Carbon\Carbon;
class SurveyController extends Controller
{
    public function index()
    {
    	$surveys = Survey::where('user_id',auth()->user()->id)->latest()->paginate(5);
    	return view('manager.survey.index',compact('surveys'));
    }

    public function create()
    {
    	$ventureIds = VentureManager::where('user_id',auth()->user()->id)
        ->pluck('venture_id');
        $ventures = Venture::whereIn('id',$ventureIds)->get();
        return view('manager.survey.create',compact('ventures'));
    }

    public function show($surveyId)
    {
    	$survey = Survey::where('id',$surveyId)->first();
        $questions = SurveyQuestion::where('survey_id',$surveyId)->with('options')->get();
        return view('manager.survey.show',compact('survey','questions'));
    }

    public function files($surveyId)
    {
        $survey = Survey::where('id',$surveyId)->first();
        $questions = SurveyQuestion::where('survey_id',$surveyId)->with('options')->get();
        return view('manager.survey.files',compact('survey','questions'));
    }

    public function store(Request $request)
    {
        $due_date = Carbon::createFromFormat('m/d/Y', $request->due_date)->format('Y-m-d');
        $survey = Survey::create([
            "subject" => $request->subject,
            "body"    => $request->body,
            "user_id" => $request->user_id,
            "venture_id" => $request->venture_id,
            "due_date" => $due_date,
            "user_id" => auth()->user()->id
        ]);

        $questions = $request->questions;

        $emailQuestions = [];
        for($i=0;$i<count($questions);$i++)
        {
            $surveyQuestion = SurveyQuestion::create([
                "question" => $questions[$i],
                "survey_id"=> $survey->id,
            ]);
            $options = $request['q-'.($i+1).'-options'];
            $optionsObj = [];
            for($j=0;$j<count($options);$j++)
            {
                $optionsObj[] = [
                    "question_id" => $surveyQuestion->id,
                    "value"     => $options[$j]
                ];
            }
            $questionOptions = QuestionOption::insert($optionsObj);

            $emailQuestions[] = [
                "question"=>$surveyQuestion,
                "options"=>$optionsObj
            ];
        }

        $emailSurvey = [
            "survey"=>$survey,
            "questions"=>$emailQuestions
        ];

        $user_ids   = VentureOwnership::where('venture_id',$request->venture_id)
        ->where('isDeleted',0)
        ->pluck('user_id');
        $emails     = User::whereIn('id',$user_ids)->pluck('email')->toArray();
        $venture    = Venture::where('id',$request->venture_id)->first();

        \Mail::send('email.surveyEmail',["emailSurvey"=>$emailSurvey,"venture"=>$venture], function ($message) use ($emails) {
            $message->from('contact@gmail.com', 'Survey Email');
            $message->to($emails)->subject('Survey Email');
        });
        return redirect('/manager/survey')->with('success','Survey Created Successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $result = $request->ids;

        $surveyIds = explode(",",$result);
        $survey = Survey::whereIn('id',$surveyIds)->delete();

        $questionIds = SurveyQuestion::whereIn('survey_id',$surveyIds)->pluck('id');
        $optionIds = QuestionOption::whereIn('question_id',$questionIds)->pluck('id');
        $pickedOptions = PickedOption::whereIn('option_id',$optionIds)->pluck('id');

        $surveyQuestion = SurveyQuestion::whereIn('id',$questionIds)->delete();
        $questionOptions = QuestionOption::whereIn('id',$optionIds)->delete();
        $pickedOptions = PickedOption::whereIn('id',$pickedOptions)->delete();


        if($survey)
        {
            return response()->json([
                'message' => "Deleted Successfully",
                'status' => true,
            ]);
        }
        else{
            return response()->json([
                'message' => "There was an error deleting",
                'status' => false,
            ]);
        }
    }

    public function surveySearch(Request $request)
    {
        try{
            $surveys = Helper::surveySearch($request->all());
            $view = (string)view('manager.survey.search_table_row',compact('surveys'));
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

    public function sendResult($surveyId)
    {

        $survey = Survey::findorfail($surveyId);

        $user_ids   = VentureOwnership::where('venture_id',$survey->venture_id)
        ->where('isDeleted',0)
        ->pluck('user_id');
        $emails     = User::whereIn('id',$user_ids)->pluck('email')->toArray();
        $venture    = Venture::where('id',$survey->venture_id)->first();

        $questions = SurveyQuestion::where('survey_id',$surveyId)->get();

        \Mail::send('email.surveyResultEmail',["survey"=>$survey,"questions"=>$questions,"venture"=>$venture], function ($message) use ($emails) {
            $message->from('contact@gmail.com', 'Survey Result Email');
            $message->to($emails)->subject('Survey Result Email');
        });

        $survey->update(["result_sent"=>1]);

        return redirect('/manager/survey')->with('success','Result Sent Successfully!');
    }

    public function uploadImages(Request $request)
    {
        try{

            $this->validate($request, [
                'images' => 'required',
                'id' => 'required',
            ]);


            $user = Auth::user();
            $survey = Survey::find($request->get('id'));

            // Adding Medias Against Ventures
            if($request->hasFile('images')){
                foreach($request->file('images') as $image) {
                    $path = Config::get('constants.surveyMediaPath');
                    $fileName = Helper::saveImage($image, $maxWidth = null, $path,  $callback = null);
                    if($fileName){
                        $survey->medias()->create([
                            'file_name' => $fileName,
                            'type' => Config::get('constants.mediaImageType'),
                            'user_id' => $user->id,
                            'visibility' => 'Visible',
                        ]);
                    }
                }
            }

            $data =  view('manager.survey.imageSection',compact('survey'))->render();

            return response()->json([
                'status' => true,
                'message' => 'Document successfully uploaded!',
                'data' => $data
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function imageDelete(Request $request){
        try{
            $media = Media::find($request->get('mediaID'));

            if(is_null($media)){
                return response()->json([
                    'status' => false,
                    'message' => 'File not found!'
                ]);
            }

            $media->delete();

            return response()->json([
                'status' => true,
                'message' => 'File deleted successfully!'
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wring, While file deleting!'
            ]);
        }
    }

    public function uploadDocument(Request $request)
    {
        try {
            $user = Auth::user();
            $survey = Survey::find($request->get('id'));

            // Adding Document Against Ventures
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $path = Config::get('constants.surveyMediaPath');
                $fileName = Helper::saveFile($file, $path);
                //if document is added
                if ($fileName) {
                    $survey->medias()->create([
                        'title' => $request->get('documentName'),
                        'file_name' => $fileName,
                        'user_id' => $user->id,
                        'visibility' => 'Visible',
                        'date_of_document_to_apply' => null,
                    ]);
                }
            }

            $data = view('manager.survey.documentTab', compact('survey'))->render();

            return response()->json([
                'status' => true,
                'message' => 'Document successfully uploaded!',
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
