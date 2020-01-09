<?php

namespace App\Http\Controllers;

use App\AssetMaster;
use Illuminate\Http\Request;
use App\Helpers\APIHelpers;
use App\Imports\AssetImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class AssetMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = AssetMaster::all();
        $response = APIHelpers::createAPIResponse(true, 200, 'Data', $assets);
        return response()->json($response, 200);
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
     * @param  \App\AssetMaster  $assetMaster
     * @return \Illuminate\Http\Response
     */
    public function show(AssetMaster $assetMaster)
    {
        //
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
    public function update(Request $request, AssetMaster $assetMaster)
    {
        //
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
     * [showRequestedAssets description]
     * @return [type] [description]
     */
    public function showRequestedAssets()
    {

    }
}
