<?php

namespace App\Http\Controllers;

use App\UserMaster;
use Illuminate\Http\Request;
use App\Imports\UserImport;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\APIHelpers;

class UserMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserMaster  $userMaster
     * @return \Illuminate\Http\Response
     */
    public function show(UserMaster $userMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserMaster  $userMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMaster $userMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserMaster  $userMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMaster $userMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserMaster  $userMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMaster $userMaster)
    {
        //
    }
    /**
     * upload the employee details to storage
     * @param  \APP\UserMaster  $usermaster
     * @return [type]           [description]
     */
    public function upload(Request $request)
    {
        $employee_save = Excel::import(new UserImport, request()->file('upload_file'));
        if ($employee_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Employee Saved', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Employee not Saved', null);
            return response()->json($response, 400);
        }
    }
}
