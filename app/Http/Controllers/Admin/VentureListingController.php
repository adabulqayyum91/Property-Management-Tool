<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\VentureListing;
use App\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\VentureRepository;



class VentureListingController extends Controller
{
    protected $repository;
    public function __construct(VentureRepository $repository)
    {
        $this->ventureRepository = $repository;

    }
    public function index()
    {
        try{
            $allVentures = VentureListing::paginate(15);
            $i = 1;
            return view('admin.layouts.pages.ventures.ventures',compact('allVentures','i'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function create()
    {
        return view('admin.layouts.pages.ventures.create');   //

    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'venture_name' => 'required|max:191',
                'initial_cap' => 'required|numeric',
                'venture_street' => 'required|max:191',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $venture=new VentureListing;
            $venture->venture_name=$request->venture_name;
            $venture->initial_cap=$request->initial_cap;
            $venture->date_of_incorporation=$request->date_of_incorporation;
            $venture->date_of_Purchase=$request->date_of_Purchase;
            $venture->purcahse_price=$request->purcahse_price;
            $venture->staff_manager=$request->staff_manager;
            $venture->managing_member=$request->managing_member;
            $venture->venture_street=$request->venture_street;
            $venture->venture_city=$request->venture_city;
            $venture->venture_state=$request->venture_state;
            $venture->venture_zip=$request->venture_zip;
            $venture->type=$request->type;
            $venture->status_id=1;
            $venture->type_id=1;
            $venture->save();
            $media = new Media;
            $media->title='test title';
            $media->file_name=$imageName;
            $venture->medias()->save($media);
            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{

            $currentVenture = VentureListing::findOrFail($id);
            return view('admin.layouts.pages.ventures.show',compact('currentVenture'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{

            $currentVenture = VentureListing::findOrFail($id);
            return view('admin.layouts.pages.ventures.edit',compact('currentVenture'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $validator = Validator::make($request->all(), [
                'venture_name' => 'required|max:191',
                'initial_cap' => 'required|numeric',
                'venture_street' => 'required|max:191',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $venture= VentureListing::find($id);
            $venture->venture_name=$request->venture_name;
            $venture->initial_cap=$request->initial_cap;
            $venture->date_of_incorporation=$request->date_of_incorporation;
            $venture->date_of_Purchase=$request->date_of_Purchase;
            $venture->purcahse_price=$request->purcahse_price;
            $venture->staff_manager=$request->staff_manager;
            $venture->managing_member=$request->managing_member;
            $venture->venture_street=$request->venture_street;
            $venture->venture_city=$request->venture_city;
            $venture->venture_state=$request->venture_state;
            $venture->venture_zip=$request->venture_zip;
            $venture->type=$request->type;
            $venture->save();
            return back();

        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $venture = VentureListing::findOrFail($id);
            $venture->delete();
            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

}
