<?php

namespace  App\Helpers;

// use Maatwebsite\Excel\Facades\Excel;
// use App\UserMaster;
// use App\AssetMaster;
// use Illuminate\Http\Request;

class APIHelpers
{
    //we can call function without creating instance of this function
    public static function createAPIResponse($is_error, $code, $message, $content)
    {
        //            $is_error -> is for error of success response
        //            $code -> return code of error
        //            $message  -> return error msg
        //            $content -> data
        $result = [];
        if ($is_error) {
            $result['success'] = false;
            $result['code'] = $code;
            $result['message'] = $message;
        } else {
            $result['success'] = true;
            $result['code'] = $code;
            if ($content == null) {
                $result['message'] = $message;
            } else {
                $result['data'] =$content;
            }
        }
        return $result;
    }


    // public static function uploadData($importClass, $upload_file)
    // {
    //     $uploaddata_save = Excel::import(new $importClass, $upload_file);
    //     if ($uploaddata_save) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }
}
