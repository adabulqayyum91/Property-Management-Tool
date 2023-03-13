<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRequestRepository;


class UserRequestController extends Controller
{
    protected $repository;
    public function __construct(UserRequestRepository $repository)
    {
        $this->userRequestRepository = $repository;

    }
    // Fetch all records from User Repository
    public function index()
    {
        try{
            $userRequests = $this->userRequestRepository->paginate($limit = 10, $columns = ['*']);
            $i = 1;
            return view('admin.layouts.pages.userrequests.users',compact('userRequests','i'));
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
                'name' => 'required|max:191',
                'email' => 'required|max:191',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $this->userRequestRepository->create( $request->all());
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
            $userRequest = $this->userRequestRepository->find($id);
            return view('admin.layouts.pages.userrequests.show',compact('userRequest'));
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }   //
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
            $userRequest = $this->userRequestRepository->find($id);
            return view('admin.layouts.pages.userrequests.edit',compact('userRequest'));
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
            $this->userRequestRepository->update( $request->all(),$id);
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
            $this->userRequestRepository->delete($id);
            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
