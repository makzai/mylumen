<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/5
 * Time: 14:39
 */

namespace App\Http\Controllers\Admin;


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
     * @api {get} admin/{pin_appid}/tasks 任务列表
     * @apiGroup Admin-Task
     * @apiUse PinCommon
     * @apiDescription 任务列表
     * @apiParam {Int} [status] 状态筛选，0-禁用，1-启用
     * @apiParam {String} [q] 搜索关键字
     * @apiSuccess {String} name 任务名称
     * @apiSuccess {String} title 文章标题
     * @apiSuccess {String} head_image 首图
     * @apiSuccess {String} created_at 创建时间
     * @apiSuccess {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "name": "任务名称",
     *                "title": "文章标题",
     *                "head_image": "http://xx/1.png",
     *                "created_at": "2018-09-04 19:04:16",
     *                "status": 1
     *            }
     *        ]
     *    }
     */
    public function index(Request $request)
    {
        $payload = $request->all();
        $task = $this->taskService->getList($payload);
        return TaskResource::collection($task);
    }

    /**
     * @api {get} admin/{pin_appid}/tasks/{id} 任务详情
     * @apiGroup Admin-Task
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

    /**
     * @api {post} admin/{pin_appid}/tasks/preview 预览任务
     * @apiGroup Admin-Task
     * @apiUse PinCommon
     * @apiDescription 预览任务
     * @apiParam {String} name 任务名称
     * @apiParam {String} title 文章标题
     * @apiParam {String} content 文章正文
     * @apiParam {Array} [images_ids] 关联图片(可能是富文本编辑器里的图片,第一张将作为首图)
     * @apiParam {Array} [product_ids] 关联商品(目前产品定义关联SPU,通过商城相关接口取得)
     * @apiParam {String} creator_id 创建者uid
     * @apiParam {String} creator_name 创建者名称
     * @apiParam {Int} status 0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "ContentType": "image/jpeg",
     *        "QRCodeImage": "图片二进制编码"
     *    }
     */
    public function preview(Request $request)
    {
        return '预览任务';
    }

    /**
     * @api {post} admin/{pin_appid}/tasks 新增任务
     * @apiGroup Admin-Task
     * @apiUse PinCommon
     * @apiDescription 新增任务
     * @apiParam {String} name 任务名称
     * @apiParam {String} title 文章标题
     * @apiParam {String} content 文章正文
     * @apiParam {Array} [images_ids] 关联图片(可能是富文本编辑器里的图片,第一张将作为首图)
     * @apiParam {Array} [product_ids] 关联商品(目前产品定义关联SPU,通过商城相关接口取得)
     * @apiParam {String} creator_id 创建者uid
     * @apiParam {String} creator_name 创建者名称
     * @apiParam {Int} status 0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    public function store(Request $request)
    {
        return '新增任务';
    }

    /**
     * @api {put} admin/{pin_appid}/tasks/{id} 修改任务
     * @apiGroup Admin-Task
     * @apiUse PinCommon
     * @apiDescription 修改任务
     * @apiParam {String} name 任务名称
     * @apiParam {String} title 文章标题
     * @apiParam {String} content 文章正文
     * @apiParam {Array} [images_ids] 关联图片(可能是富文本编辑器里的图片,第一张将作为首图)
     * @apiParam {Array} [product_ids] 关联商品(目前产品定义关联SPU,通过商城相关接口取得)
     * @apiParam {String} creator_id 创建者uid
     * @apiParam {String} creator_name 创建者名称
     * @apiParam {Int} status 0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    public function update(Request $request, $id)
    {
        return '修改任务';
    }

    /**
     * @api {delete} admin/{pin_appid}/tasks/{id} 删除任务
     * @apiGroup Admin-Task
     * @apiUse PinCommon
     * @apiDescription 删除任务
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    public function destroy($id)
    {
        return '删除任务';
    }
}