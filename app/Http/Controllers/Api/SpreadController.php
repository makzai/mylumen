<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\SpreadResource;
use App\Http\Resources\Api\SpreadShowResource;
use App\Http\Validators\Api\StoreSpreadValidator;
use App\Repositories\SpreadRepository;
use App\Services\SpreadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpreadController extends Controller
{

    /**
     * @api {get} admin/{pin_appid}/spreads 我的传播
     * @apiGroup Api-Spread
     * @apiUse PinCommon
     * @apiDescription 我的传播，列表
     * @apiSuccess {String} capital_img 传播首图
     * @apiSuccess {Int} pv 阅读数
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "title": "传播标题",
     *                "capital_img": "http://xx/1.png",
     *                "pv": 100,
     *                "created_at": "2018-09-04 19:04:16"
     *            }
     *        ]
     *    }
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        // TODO 统计服务，图片服务

        $repo = new SpreadRepository();
        $params = $this->paramsWithPinHeader($request);
        $params['seller_id'] = $request->header('X-Pin-UID');
        $data = $repo->getList($params);

        return SpreadResource::collection($data);
    }

    /**
     * @api {post} admin/{pin_appid}/spreads 创建传播
     * @apiGroup Api-Spread
     * @apiUse PinCommon
     * @apiDescription 创建传播
     * @apiParam {String} title 标题
     * @apiParam {String} [content] 正文
     * @apiParam {Array} [product_ids] 直接创建传播时，关联商品
     * @apiParam {String} [description] 转发文章时填的文本
     * @apiParam {Int} type 传播类型，1-直接创建，2-做任务，3-引用转发
     * @apiParam {Int} [mission_id] 做任务时，mission_id
     * @apiParam {Int} [resource_id] 转发文章/海报/商品时，资料库resource_id
     */

    /**
     * @param Request $request
     * @return string
     * @throws
     */
    public function store(Request $request)
    {
        $validator = new StoreSpreadValidator();
        $validator->check($request->all());

        $service = new SpreadService();
        $params = $this->paramsWithPinHeader($request);
        $params['seller_id'] = $request->header('X-Pin-UID');
        $params = $service->secureParamForCreate($params);
        $service->create($params);

        return $this->success();
    }

    /**
     * @api {get} admin/{pin_appid}/spreads/{id} 传播详情
     * @apiGroup Api-Spread
     * @apiUse PinCommon
     * @apiDescription 传播详情
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "id": 232425,
     *        "title": "传播标题",
     *        "creator": {
     *            "uid": 23,
     *            "name": "小明",
     *         },
     *        "product": [],
     *        "description": "转发时追加的内容",
     *        "content": "正文",
     *        "images": [],
     *        "created_at": "2018-09-04 19:15:06"
     *    }
     */

    /**
     * @param $id
     * @return SpreadShowResource
     * @throws \Throwable
     */
    public function show($id)
    {
        // 被删除的传播，已经分享出去了，还显示么？

        $repo = new SpreadRepository();
        $info = $repo->getInfo($id);

        return new SpreadShowResource($info);
    }

    /**
     * @api {delete} admin/{pin_appid}/spreads/{id} 删除传播
     * @apiGroup Api-Spread
     * @apiUse PinCommon
     * @apiDescription 删除我的一条传播
     */

    /**
     * @param $id
     * @return string
     * @throws
     */
    public function destroy($id)
    {
        $service = new SpreadService();
        $service->destroy($id);

        return $this->success();
    }
}
