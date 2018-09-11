<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\StoreResource;
use App\Http\Validators\Admin\StoreValidator;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * @api {get} admin/{pin_appid}/stores 门店列表
     * @apiGroup Admin-Store
     * @apiUse PinCommon
     * @apiDescription 门店列表
     * @apiSuccess {String} name 门店名称
     * @apiSuccess {String} province 省
     * @apiSuccess {String} city 市
     * @apiSuccess {String} district 区
     * @apiSuccess {String} detail 详细地址
     * @apiSuccess {String} phone 电话号码
     * @apiSuccess {String} created_at 创建时间
     * @apiSuccess {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "name": "门店名称",
     *                "province": "广东省",
     *                "city": "广州市",
     *                "district": "海珠区",
     *                "detail": "宝地广场",
     *                "phone": "110",
     *                "created_at": "2018-09-04 19:04:16",
     *                "status": 1
     *            }
     *        ]
     *    }
     */
    public function index(Request $request)
    {
        $payload = $this->paramsWithPinHeader($request);
        $task = $this->storeService->getList($payload);
        return StoreResource::collection($task);
    }

    /**
     * @api {post} admin/{pin_appid}/stores 新增门店
     * @apiGroup Admin-Store
     * @apiUse PinCommon
     * @apiDescription 新增门店
     * @apiParam {String} name 门店名称
     * @apiParam {String} province 省
     * @apiParam {String} city 市
     * @apiParam {String} district 区
     * @apiParam {String} detail 详细地址
     * @apiParam {String} phone 电话号码
     * @apiParam {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    /**
     * @apiIgnore
     * @throws
     */
    public function store(Request $request)
    {
        $validator = new StoreValidator();
        $validator->check($request->all());

        $payload = $this->paramsWithPinHeader($request);
        $this->storeService->create($payload);
        return $this->success();
    }

    /**
     * @api {put} admin/{pin_appid}/stores/{id} 修改门店
     * @apiGroup Admin-Store
     * @apiUse PinCommon
     * @apiDescription 修改门店
     * @apiParam {String} name 门店名称
     * @apiParam {String} province 省
     * @apiParam {String} city 市
     * @apiParam {String} district 区
     * @apiParam {String} detail 详细地址
     * @apiParam {String} phone 电话号码
     * @apiParam {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    /**
     * @apiIgnore
     * @throws
     */
    public function update(Request $request, $id)
    {
        $validator = new StoreValidator();
        $validator->check($request->all());

        $payload = $this->paramsWithPinHeader($request);
        $this->storeService->update($payload, $id);
        return $this->success();

    }

    /**
     * @api {delete} admin/{pin_appid}/stores/{id} 删除门店
     * @apiGroup Admin-Store
     * @apiUse PinCommon
     * @apiDescription 删除门店
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    public function destroy($id)
    {
        // TODO 判断不能删除条件,如门店有关联店员

        $this->storeService->destroy($id);
        return $this->success();
    }
}