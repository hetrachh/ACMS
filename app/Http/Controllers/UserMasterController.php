<?php

namespace App\Http\Controllers;

use Session;
use App\UserMaster;
use App\AssetMaster;
use App\ComplaintMaster;
use Illuminate\Http\Request;
use App\Imports\UserImport;
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
    public function login(Request $request)
    {
        $data = UserMaster::where('emp_email', $request->input('emp_email'))->where('emp_password', $request->input('emp_password'))->first();

        //echo $data;
        //echo isset ($data);

        if (isset($data) == 1) {
            $email = $request->input('emp_email');
            $request->session()->put('login_id', $email);
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

    public function seecomplain(Request $request)
    {
        $email = $request->session()->get('login_id');
        $check = strcasecmp($email, "");
        if ($check == 0) {
            return response("You Are Not Log In Yet.", 404);
        } else {
            $id = UserMaster::where('emp_email', $email)->first();
            $data = ComplaintMaster::where('emp_code', $id['emp_code'])->orderBy('status')->get();
            if (count($data) < 0) {
                return response("You Don't Register Any Complaint", 404);
            } else {
                return response($data, 200);
            }
        }
    }

    public function seeasset(Request $request)
    {
        $email = $request->session()->get('login_id');
        $check = strcasecmp($email, "");
        if ($check == 0) {
            return response("You Are Not Log In Yet.", 404);
        } else {
            $id = UserMaster::where('emp_email', $email)->first();
            $data = AssetMaster::where('emp_code', $id['emp_code'])->orderBy('created_at')->get();
            if (count($data) < 0) {
                return response("You Don't Have Single Asset.", 404);
            } else {
                return response($data, 200);
            }
        }
    }

    public function selfsolve(Request $request, $cid)
    {
        $email = $request->session()->get('login_id');
        $check = strcasecmp($email, "");
        if ($check == 0) {
            return response("You Are Not Log In Yet.", 404);
        } else {
            
            $complian = ComplaintMaster::where("complaint_id", $cid)->update(['status' => 2]);

            return response("Status Updated To Solved.", 200);
        }
    }

    public function logout(Request $request)
    {
        $email = $request->session()->get('login_id');
        $check = strcasecmp($email, "");
        if ($check == 0) {
            return response("You Are Not Log In Yet.", 404);
        } else {
            $request->session()->flush();
            return response("Log Out.", 200);
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

    public function empupdatepass(Request $request)
    {
        $email = $request->session()->get('login_id');
        $check = strcasecmp($email, "");
        if ($check == 0) {
            return response("You Are Not Log In Yet.", 404);
        } else {
            $cpass = UserMaster::select("emp_password")->where('emp_email', $email)->first();
            //echo $cpass;
            $current_pass = $request->input('current_pass');
            $check = strcasecmp($cpass['emp_password'], $current_pass);
            if ($check == 0) {
                $npass = $request->input("new_pass");
                $cnpass = $request->input("cnew_pass");
                if (strcasecmp($npass, $cnpass) == 0) {
                    $id = UserMaster::where('emp_email', $email)->update(['emp_password'=>$npass]);

                    return response("Password Changed.", 200);
                } else {
                    return response("New Password & Confirm Password Not Match.", 422);
                }
            } else {
                return response("Wrong Current Password.", 422);
            }
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
