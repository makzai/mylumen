<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @api {get} user/{pin_uid}/task 任务列表
     * @apiGroup Api-Task
     * @apiUse PinCommon
     * @apiDescription 任务列表
     * @apiSuccess {String} name 任务名称
     * @apiSuccess {String} title 文章标题
     * @apiSuccess {String} head_image 首图
     * @apiSuccess {String} creator_name 创建者名称
     * @apiSuccess {String} created_at 创建时间
     * @apiSuccess {Int} status 状态，0-禁用，1-启用
     * @apiSuccess {Int} participation 参与状态，0-未参与，1-已参与
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "name": "任务名称",
     *                "title": "文章标题",
     *                "head_image": "http://xx/1.png",
     *                "creator_name": "企业管理员",
     *                "created_at": "2018-09-04 19:04:16",
     *                "status": 1
     *                "participation": 1
     *            }
     *        ]
     *    }
     */
    public function index()
    {
        $task = $this->taskService->getList();
        return TaskResource::collection($task);
    }

    /**
     * @api {get} user/{pin_uid}/task/{id} 任务详情
     * @apiGroup Api-Task
     * @apiUse PinCommon
     * @apiDescription 任务详情
     * @apiSuccess {String} name 任务名称
     * @apiSuccess {String} title 文章标题
     * @apiSuccess {String} head_image 首图
     * @apiSuccess {String} creator_name 创建者名称
     * @apiSuccess {String} created_at 创建时间
     * @apiSuccess {String} content 文章正文
     * @apiSuccess {Array} products 关联商品
     * @apiSuccess {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "id": 232425,
     *        "name": "任务名称",
     *        "title": "文章标题",
     *        "head_image": "http://xx/1.png",
     *        "creator_name": "企业管理员",
     *        "created_at": "2018-09-04 19:15:06",
     *        "content": "正文部分",
     *        "products": [],
     *        "status": 1
     *    }
     */
    public function show($id)
    {
        return $id;

    }

}