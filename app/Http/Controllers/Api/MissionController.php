<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/5
 * Time: 14:40
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    /**
     * @api {post} user/{pin_uid}/mission 接任务
     * @apiGroup Api-Mission
     * @apiUse PinCommon
     * @apiDescription 接任务
     * @apiParam {String} task_id 任务ID
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        true
     *    }
     */
    public function store(Request $request)
    {
        return '接任务';
    }
}