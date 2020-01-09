<?php

namespace  App\Helpers;

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
}
