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
        $users = UserMaster::all();
        if (count($users) > 0) {
            $response = APIHelpers::createAPIResponse(false, 200, 'users are', $users);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'No user found', null);
            return response()->json($response, 404);
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
        $user           = new UserMaster;
        $user->emp_code = $request->input('emp_code');
        $user->emp_name = $request->input('emp_name');
        $user->emp_phno = $request->input('emp_phno');
        $user->emp_email = $request->input('emp_email');
        $user->emp_designation = $request->input('emp_designation');
        $user->emp_password = $request->input('emp_password');
        // $user->emp_status = $request->input('emp_status');
        $user->emp_type = $request->input('emp_type');
        $user_save      = $user->save();
        if ($user_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'user saved!', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'user not saved', null);
            return response()->json($response, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserMaster  $userMaster
     * @return \Illuminate\Http\Response
     */
    public function show(UserMaster $userMaster, $id)
    {
        $user = UserMaster::find($id);
        if (count($user)) {
            $response = APIHelpers::createAPIResponse(false, 200, 'users!', $user);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'user not found', null);
            return response()->json($response, 404);
        }
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
    public function update(Request $request, UserMaster $userMaster, $id)
    {
        $user = UserMaster::find($id);
        $user->emp_code = $request->input('emp_code');
        $user->emp_name = $request->input('emp_name');
        $user->emp_phno = $request->input('emp_phno');
        $user->emp_email = $request->input('emp_email');
        $user->emp_designation = $request->input('emp_designation');
        $user->emp_status = $request->input('emp_status');
        $user->emp_type = $request->input('emp_type');
        $user_save      = $user->save();
        if ($user_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'user Updated!', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'user Not Updated', null);
            return response()->json($response, 400);
        }
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
