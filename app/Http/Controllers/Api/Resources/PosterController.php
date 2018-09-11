<?php

namespace App\Http\Controllers\Api\Resources;

use App\Http\Resources\Api\Resources\PosterResource;
use App\Http\Resources\Api\Resources\PosterShowResource;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosterController extends Controller
{

    /**
     * @api {get} user/{pin_uid}/resources/posters 海报列表
     * @apiGroup Api-Resource
     * @apiUse PinCommon
     * @apiDescription 获取资料库的海报列表
     * @apiParam {String} [q] 搜索关键字
     * @apiParam {String} [sort=time] 排序方式（time-按时间排序，hot_share-按分享人数排序）
     * @apiSuccess {String} capital_img 海报图片
     * @apiSuccess {Int} seller_share_count 分享员工数
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "title": "海报标题",
     *                "capital_img": "http://xx/1.png",
     *                "seller_share_count": 9,
     *                "created_at": "2018-09-04 19:04:16"
     *            }
     *        ]
     *    }
     */

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        // 按创建时间排序，新创建的排前
        // 不显示禁用的条目

        // TODO hot_share-按分享人数排序

        $repo = new ResourceRepository();
        $params = $this->paramsWithPinHeader($request);
        $params['status'] = Resource::STA_ENABLE;
        $data = $repo->getList($params, Resource::TYPE_POSTER);

        return PosterResource::collection($data);
    }

    /**
     * @api {get} user/{pin_uid}/resources/posters/{id} 海报详情
     * @apiGroup Api-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库海报详情
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "id": 232425,
     *        "title": "海报标题",
     *        "capital_img": "http://xx/1.png",
     *        "seller_share_count": 9,
     *        "created_at": "2018-09-04 19:15:06"
     *    }
     */

    /**
     * @param $id
     * @return PosterShowResource
     * @throws
     */
    public function show($id)
    {
        $repo = new ResourceRepository();
        $info = $repo->getInfo($id, Resource::TYPE_POSTER);

        return new PosterShowResource($info);
    }
}
