<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @apiDefine PinCommon
     * @apiHeader {String} X-Pin-Authorization 品快token
     */

    protected function paramsWithPinHeader(Request $request)
    {
        return $params = array_merge($request->all(), [
            'corp_id' => $request->headers->get('X-Pin-CorpID'),
            'app_id' => $request->headers->get('X-Pin-AppID'),
            'pin_uid' => $request->headers->get('X-Pin-UID'),
        ]);
    }

    protected function success($message=null)
    {
        return 'success';
    }
}
