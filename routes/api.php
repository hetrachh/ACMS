<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/users', 'UserMasterController');
Route::resource('/assets', 'AssetMasterController');
Route::resource('/complaint', 'ComplaintMasterController');

Route::post('/upload_employee', 'UserMasterController@upload');
Route::post('/upload_asset', 'AssetMasterController@upload');
Route::post('/showAssets', 'AssetMasterController@showAllocatedAssets');
Route::post('/login', 'UserMasterController@login');
Route::get('/logout', 'UserMasterController@logout');
Route::get('/see_complain', 'UserMasterController@seecomplain');
Route::get('/self_solved/{cid}', 'UserMasterController@selfsolve');
Route::get('/see_asset', 'UserMasterController@seeasset');
Route::post('/emp_update_pass', 'UserMasterController@empupdatepass');

Route::post('/register_complain', 'ComplaintMasterController@store');
