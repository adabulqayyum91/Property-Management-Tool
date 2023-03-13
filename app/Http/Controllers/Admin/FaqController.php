<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\FaqRepository;

class FaqController extends Controller
{
    protected $repository;
    public function __construct(FaqRepository $repository)
    {
        $this->faqRepository = $repository;

    }
    // Fetch all records from Faq Repository
    public function index()
    {
        try{
            $allFaqs = $this->faqRepository->paginate($limit = 10, $columns = ['*']);
            return view('admin.layouts.pages.faqs.faqs',compact('allFaqs'));
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
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:191',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $this->faqRepository->create( $request->all());
            return back();
        }catch (\Exception $e) {
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
        try{
            $currentFaq = $this->faqRepository->find($id);
            return view('admin.layouts.pages.faqs.show',compact('currentFaq'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        try{
            $currentFaq = $this->faqRepository->find($id);
            return view('admin.layouts.pages.faqs.edit',compact('currentFaq'));
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
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();

            }
            $this->faqRepository->update([
                'title'=>$request->get('title'),
                'description'=>$request->get('description')
            ],$id);
            return back();
        }catch (\Exception $e) {
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
        try {
            $this->faqRepository->delete($id);
            return back();
        }catch(\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
