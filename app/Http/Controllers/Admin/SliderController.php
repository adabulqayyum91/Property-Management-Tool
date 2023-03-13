<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Toastr;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $allSliders = Slider::paginate(10);
            return view('admin.layouts.pages.slider.slider',compact('allSliders'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:191',
                'description' => 'required|max:191',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect('admin/slider')
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            if ($request->hasFile('photo')) {
                $imageName = $this->fileUpload($request);
                $input['photo'] = $imageName;
            }
            Slider::create($input);
            return back();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $currentSlider = Slider::findorfail($id);
            return view('admin.layouts.pages.slider.edit',compact('currentSlider'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:191',
                'description' => 'required|max:191',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            $currentSlider = Slider::findorfail($id);
//            dd($slider['photo']);
            if(isset($input['photo'])){
                if ($request->hasFile('photo')) {
//                    dd('abc');
                    $imageName = $this->fileUpload($request);
                    if($currentSlider->photo && \File::exists(public_path('img/banner/') . $currentSlider->photo)){
                        unlink(public_path('img/banner/') . $currentSlider->photo);
                    }
                    $input['photo'] = $imageName;
                }
            }else{
//                dd('abc');
                $input['photo'] = $currentSlider->photo;
            }
            $currentSlider->update($input);
            return back();
        }
        catch (\Exception $e) {
//            dd($e);
//            Toastr::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $currentSlider = Slider::Findorfail($id);
            $file_path = public_path('img/banner/'.$currentSlider->photo);
            if($currentSlider->photo && \File::exists($file_path)){
                unlink($file_path);
            }
            $currentSlider->delete();
            return back();
        }catch (\Exception $e) {
//            dd($e);
            return back()->withErrors($e->getMessage())->withInput();
        }

    }
    private function fileUpload($request)
    {
        $image = $request->file('photo');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $imageName1 = $imageName;
        $destinationPath = public_path('/img/banner');
        $image->move($destinationPath, $imageName);
        return $imageName1;
    }


}
