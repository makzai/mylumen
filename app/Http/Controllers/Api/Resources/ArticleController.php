<?php

namespace App\Http\Controllers\Api\Resources;

use App\Http\Resources\Api\Resources\ArticleResource;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    /**
     * @api {get} user/{pin_uid}/resources/articles 文章列表
     * @apiGroup Api-Resource
     * @apiUse PinCommon
     * @apiDescription 获取资料库的文章列表
     * @apiParam {String} [q] 搜索关键字
     * @apiParam {String} [sort=time] 排序方式（time-按时间排序，hot_share-按分享人数排序）
     * @apiSuccess {String} capital_img 文章首图
     * @apiSuccess {Int} seller_share_count 分享员工数
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "title": "文章标题",
     *                "capital_img": "http://xx/1.png",
     *                "seller_share_count": 9,
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
        // 按最新勾选时间排序，新创建的排前
        // 不显示禁用的条目

        // TODO hot_share-按分享人数排序

        $repo = new ResourceRepository();
        $params = $this->paramsWithPinHeader($request);
        $params['status'] = Resource::STA_ENABLE;
        $data = $repo->getList($params, Resource::TYPE_ARTICLE);

        return ArticleResource::collection($data);
    }
}
