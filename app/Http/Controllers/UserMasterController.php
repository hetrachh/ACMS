<?php

namespace App\Http\Controllers;

use Session;
use App\UserMaster;
use Illuminate\Http\Request;

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
        
    }

    public function login(Request $request)
    {
        $data = UserMaster::where('emp_email', $request->input('emp_email'))->where('emp_password', $request->input('emp_password'))->first();

        //echo $data;
        //echo isset ($data);

        if (isset($data) == 1) {
            $email = $request->input('emp_email');
            Session::put('login_id', $email);
            $utype = UserMaster::where('emp_code', $data['emp_code'])->first();
            if ($utype['emp_type'] == 1) {
                return response("Loged In As Admin.(Server Manager).", 200);
            } else {
                return response("Loged In As Employee.", 200);
            }

        } else {
            return response("You Are Not Regster yet", 404);
        }
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
}
