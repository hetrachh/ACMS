<?php

namespace App\Http\Controllers;

use App\AssetMaster;
use App\UserMaster;
use Illuminate\Http\Request;
use App\Helpers\APIHelpers;
use App\Imports\AssetImport;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class AssetMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assets = AssetMaster::all();
        if (count($assets) > 0) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Assets Are::', $assets);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'There are no assets', null);
            return response()->json($response, 200);
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
        $asset = new AssetMaster;
        $asset->asset_id       = $request->input('asset_id');
        $asset->asset_category = $request->input('asset_category');
        $asset->asset_name     = $request->input('asset_name');
        // $asset->asset_remark   = $request->input('asset_remark');
        // $asset->asset_status   = $request->input('asset_status');
        $asset_save            = $asset->save();
        if ($asset_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Assset Save', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Assset not Save', null);
            return response()->json($response, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AssetMaster  $assetMaster
     * @return \Illuminate\Http\Response
     */
    public function show(AssetMaster $assetMaster, $id)
    {
        $assets = AssetMaster::find($id);
        if ($assets) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Asset', $assets);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 404, 'Asset not found', null);
            return response()->json($response, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssetMaster  $assetMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetMaster $assetMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssetMaster  $assetMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetMaster $assetMaster, $id)
    {
        $asset = AssetMaster::find($id);
        $asset->asset_remark = $request->input('asset_remark');
        $asset->asset_status = 0;
        $asset_save = $asset->save();
        if ($asset_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Asset status Updated', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Asset status not Updated', null);
            return response()->json($response, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssetMaster  $assetMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetMaster $assetMaster)
    {
        //
    }

    /**
     * [upload description]
     * @return [type] [description]
     */
    public function upload()
    {
        $asset_save = Excel::import(new AssetImport, request()->file('upload_file'));
        if ($asset_save) {
            $response = APIHelpers::createAPIResponse(false, 200, 'Asset Saved', null);
            return response()->json($response, 200);
        } else {
            $response = APIHelpers::createAPIResponse(true, 400, 'Asset not Saved', null);
            return response()->json($response, 400);
        }
    }

    /**
     * [showAllocatedAssets description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showAllocatedAssets(Request $request)
    {
        $employee = UserMaster::where('emp_code', $request->input('emp_code'))->first();
        $assetdata = AssetMaster::where('emp_code', $request->input('emp_code'))->get();
        $employeename = $employee['emp_name'];
        if (count($assetdata) == 0) {
            $response = APIHelpers::createAPIResponse(true, 404, 'This Employee dont have any Assets ', $assetdata);
            return response()->json($response);
        } else {
            $assetdata->put('emp_name', $employeename);
            $response = APIHelpers::createAPIResponse(false, 200, 'This Employee dont have any Assets ', $assetdata);
            return response()->json($response);
        }
    }
}
