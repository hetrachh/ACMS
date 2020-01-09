<?php

namespace App\Http\Controllers;

use App\ComplaintMaster;
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
    public function index()
    {
        $complaints = ComplaintMaster::all();
        if ($complaints) {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComplaintMaster  $complaintMaster
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintMaster $complaintMaster)
    {
        $emp_code  = Session::get('login_id');
        $complaint = ComplaintMaster::where('emp_code', $emp_code)->get();
        if (count($complaint) > 0) {
                $response = APIHelpers::createAPIResponse(true, 200, 'Data', $complaint);
                return response()->json($response, 200);
        } else {
                $response = APIHelpers::createAPIResponse(false, 404, 'No Complaints', null);
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
            $response = APIHelpers::createAPIResponse(true, 200, 'Complaint Update', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(false, 400, 'Complaint not  Update', null);
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
