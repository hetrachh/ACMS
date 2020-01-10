<?php

namespace App\Http\Controllers;

use App\ComplaintMaster;
use App\AssetMaster;
use App\UserMaster;
use Session;
use Illuminate\Http\Request;
use App\Helpers\APIHelpers;
use Session;

class ComplaintMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * this function will be executed when admin login
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $complaints = ComplaintMaster::all();
        if (count($complaints) > 0) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Complaints are', $complaints);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Hurraay No complaints', null);
            return response()->json($response, 400);
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
    public function show(ComplaintMaster $complaintMaster, $id)
    {
        $complaint = ComplaintMaster::find($id);
        if (count($complaint) > 0) {
                $response = APIHelpers::createAPIResponse(true, 200, 'Complaint', $complaint);
                return response()->json($response, 200);
        } else {
                $response = APIHelpers::createAPIResponse(false, 404, 'No Complaint found', null);
                return response()->json($response, 404);
        }
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
    public function update(Request $request, ComplaintMaster $complaintMaster, $id)
    {
        $complaint_status = $request->input('complaint_status');
        $complaint = ComplaintMaster::find($id);
        $complaint->status = $complaint_status;
        $comlaintSave = $complaint->save();
        if ($comlaintSave) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Complaint Update', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Complaint not  Update', null);
            return response()->json($response, 400);
        }
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
