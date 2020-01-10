<?php

namespace App\Http\Controllers;

use App\ComplaintMaster;
use App\AssetMaster;
use App\UserMaster;
use Session;
use Illuminate\Http\Request;

class ComplaintMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $email = $request->session()->get('login_id');
        $check = strcasecmp($email, "");
        if ($check == 0) {
            return response("You Are Not Log In Yet.", 404);
        } else {
            
            $complain = new ComplaintMaster;
            $email = $request->session()->get('login_id');

             //echo $email;
            $id = UserMaster::where('emp_email', $email)->first();
            //echo $id;
            $complain->emp_code = $id['emp_code'];
            //$complain->complaint_id = $request->input('complaint_id');
            //$complain->emp_code = $request->input('emp_code');
            $complain->asset_id = $request->input('asset_id');
            $asset = AssetMaster::where('asset_id', $request->input('asset_id'))->first();
            $complain->asset_category = $asset['asset_category'];
            $complain->asset_name = $asset['asset_name'];
            $complain->row_no = $request->input('row_no');
            $complain->desk_no = $request->input('desk_no');
            $complain->compaint_desc = $request->input('compaint_desc');
            $complain->status = 1;

            $complain->save();
        
            return response("Request is send.", 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComplaintMaster  $complaintMaster
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintMaster $complaintMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ComplaintMaster  $complaintMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintMaster $complaintMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComplaintMaster  $complaintMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintMaster $complaintMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComplaintMaster  $complaintMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintMaster $complaintMaster)
    {
        //
    }
}
