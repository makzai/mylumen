<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SellerResource;
use App\Http\Validators\Admin\SellerValidator;
use App\Services\SellerService;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    protected $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    /**
     * @api {get} admin/{pin_appid}/sellers 店员列表
     * @apiGroup Admin-Seller
     * @apiUse PinCommon
     * @apiDescription 店员列表
     * @apiSuccess {String} pin_uid 品快uid
     * @apiSuccess {String} store_id 门店id
     * @apiSuccess {String} account 账号
     * @apiSuccess {String} name 名称
     * @apiSuccess {String} phone 电话
     * @apiSuccess {String} head_img 头像
     * @apiSuccess {String} wechat 微信号
     * @apiSuccess {Array} wechat_info 微信信息
     * @apiSuccess {Number} role 角色
     * @apiSuccess {String} job_title 职称
     * @apiSuccess {String} created_at 创建时间
     * @apiSuccess {Number} status 状态，0-禁用，1-启用
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
        $seller = $this->sellerService->getList($payload);
        return SellerResource::collection($seller);
    }

    /**
     * @api {post} admin/{pin_appid}/sellers 新增店员
     * @apiGroup Admin-Seller
     * @apiUse PinCommon
     * @apiDescription 新增店员
     * @apiParam {String} store_id 门店id
     * @apiParam {String} account 账号
     * @apiParam {String} name 名称
     * @apiParam {String} phone 电话
     * @apiParam {String} wechat 微信号
     * @apiParam {Number} role 角色
     * @apiParam {String} job_title 职称
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
        $validator = new SellerValidator();
        $validator->check($request->all());

        $payload = $this->paramsWithPinHeader($request);
        $this->sellerService->create($payload);
        return $this->success();
    }

    /**
     * @api {put} admin/{pin_appid}/sellers/{id} 修改店员
     * @apiGroup Admin-Seller
     * @apiUse PinCommon
     * @apiDescription 修改店员
     * @apiParam {String} store_id 门店id
     * @apiParam {String} account 账号
     * @apiParam {String} name 名称
     * @apiParam {String} phone 电话
     * @apiParam {String} wechat 微信号
     * @apiParam {Number} role 角色
     * @apiParam {String} job_title 职称
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
        $validator = new SellerValidator();
        $validator->check($request->all());

        $payload = $this->paramsWithPinHeader($request);
        $this->sellerService->update($payload, $id);
        return $this->success();

    }

    /**
     * @api {delete} admin/{pin_appid}/sellers/{id} 删除店员
     * @apiGroup Admin-Seller
     * @apiUse PinCommon
     * @apiDescription 删除店员
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "success"
     *    }
     */
    public function destroy($id)
    {
        // TODO 判断不能删除条件,如门店有关联店员

        $this->sellerService->destroy($id);
        return $this->success();
    }
}