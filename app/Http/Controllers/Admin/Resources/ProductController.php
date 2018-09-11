<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Resources\Admin\Resources\ProductResource;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use App\Services\Resources\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * @api {get} admin/{pin_appid}/resources/products 商品列表
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 获取资料库的商品列表
     * @apiParam {String} [q] 搜索关键字
     * @apiSuccess {String} capital_img 商品SPU图
     * @apiSuccess {Int} price 商品价格，单位分
     * @apiSuccess {Int} seller_share_count 分享员工数
     * @apiSuccess {Int} uv 浏览用户数
     * @apiSuccess {Int} buy_count 购买次数
     * @apiSuccess {String} created_at 商品加入资料库的时间
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "title": "商品标题",
     *                "capital_img": "http://xx/1.png",
     *                "price": 900,
     *                "seller_share_count": 9,
     *                "uv": 100,
     *                "buy_count": 6,
     *                "status": 1,
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
        // 显示该SPU的第一个SKU的价格
        // 购买次数，指来源于商品分享和非任务传播，到达商品详情页并支付下单的总次数（累加不去重）

        $repo = new ResourceRepository();
        $params = $this->paramsWithPinHeader($request);
        $data = $repo->getList($params, Resource::TYPE_PRODUCT);

        // TODO 统计服务，图片服务

        return ProductResource::collection($data);
    }

    /**
     * @api {get} admin/{pin_appid}/resources/products/joined 已添加商品的id列表
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 返回已经加入资料库的商品的product_id
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "product_ids": ["9", "13", "15"]
     *    }
     */

    /**
     * @param Request $request
     * @return mixed
     */
    public function joined(Request $request)
    {
        $corpId = $request->header('X-Pin-CorpID');
        $appId = $request->header('X-Pin-AppID');
        $service = new ProductService();
        $result = $service->getJoinedProductIds($corpId, $appId);

        return ['product_ids' => $result];
    }

    /**
     * @api {post} admin/{pin_appid}/resources/products/choose 选取商品
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 把选中商品加入资料库，把取消选中的从资料库移除
     * @apiParamExample {json} Request-Example:
     *    {
     *        "product_ids": ["9", "13", "15"]
     *    }
     */

    /**
     * @param Request $request
     * @return string
     */
    public function choose(Request $request)
    {
        return $this->success();
    }

    /**
     * @api {delete} admin/{pin_appid}/resources/products/{id} 删除商品
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 把商品从资料库删除
     */

    /**
     * @param $id
     * @return string
     * @throws
     */
    public function destroy($id)
    {
        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $service = new ProductService();
        $service->destroy($id);

        return $this->success();
    }
}
