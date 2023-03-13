<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\LogRepository;

class LogController extends Controller
{
    protected $repository;
    public function __construct(LogRepository $repository)
    {
        $this->logRepository = $repository;

    }
    // Fetch all records from Log Repository
    public function index()
    {
        try{

            $allLogs = $this->logRepository->paginate($limit = 10, $columns = ['*']);

            $i = 1;
            return view('admin.layouts.pages.logs.logs',compact('allLogs','i'));
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

     */
    public function store(Request $request)
    {
        return $this->logRepository->create( $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\log  $log
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->logRepository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *

     */
    public function update(Request $request, $id)
    {
        return $this->logRepository->update( $request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    // Delete Specific Record Through Log Repository
    public function destroy($id)
    {
        try {
            $this->logRepository->delete($id);
            return back();
        }catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
