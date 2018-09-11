<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Resources\Admin\Resources\ArticleResource;
use App\Http\Resources\Admin\Resources\ArticleShowResource;
use App\Http\Validators\Admin\StoreResourceArticleValidator;
use App\Http\Validators\Admin\UpdateResourceArticleValidator;
use App\Repositories\ResourceRepository;
use App\Services\Resources\ArticleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Resource;

class ArticleController extends Controller
{

    /**
     * @api {get} admin/{pin_appid}/resources/articles 文章列表
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 获取资料库的文章列表
     * @apiParam {Int} [status] 状态筛选，0-禁用，1-启用
     * @apiParam {String} [q] 搜索关键字
     * @apiSuccess {String} capital_img 文章首图
     * @apiSuccess {Int} seller_share_count 分享员工数
     * @apiSuccess {Int} uv 浏览用户数
     * @apiSuccess {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "title": "文章标题",
     *                "capital_img": "http://xx/1.png",
     *                "seller_share_count": 9,
     *                "uv": 100,
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
        // TODO 首图是什么图
        // 文章的第一张图？文章没图呢？
        // 关联商品的主图？没关联商品呢？
        // 手动设置的？没有设置的地方呀

        // TODO 统计服务，图片服务

        $repo = new ResourceRepository();
        $params = $this->paramsWithPinHeader($request);
        $data = $repo->getList($params, Resource::TYPE_ARTICLE);

        return ArticleResource::collection($data);
    }

    /**
     * @api {post} admin/{pin_appid}/resources/articles 新增文章
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库文章新增
     * @apiParam {String} title 标题
     * @apiParam {String} content 正文
     * @apiParam {Array} [product_ids] 关联商品
     * @apiParam {Int} [sort] 排序
     * @apiParam {String} creator_id 作者id
     * @apiParam {String} creator_name 作者名称
     * @apiParam {Int} status 0-禁用，1-启用
     */

    /**
     * @param Request $request
     * @return string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = new StoreResourceArticleValidator();
        $validator->check($request->all());

        $service = new ArticleService();
        $params = $this->paramsWithPinHeader($request);
        $params = $service->secureParamForCreate($params);
        $service->create($params);

        return $this->success();
    }

    /**
     * @api {get} admin/{pin_appid}/resources/articles/{id} 文章详情
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库文章详情
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "id": 232425,
     *        "title": "文章标题",
     *        "creator": {
     *            "uid": 23,
     *            "name": "小明",
     *         },
     *        "product": [],
     *        "content": "正文",
     *        "created_at": "2018-09-04 19:15:06"
     *    }
     */

    /**
     * @param $id
     * @return ArticleShowResource
     * @throws \Throwable
     */
    public function show($id)
    {
        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $repo = new ResourceRepository();
        $info = $repo->getInfo($id, Resource::TYPE_ARTICLE);

        return new ArticleShowResource($info);
    }

    /**
     * @api {put} admin/{pin_appid}/resources/articles/{id} 修改文章
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库文章修改
     * @apiParam {String} [title] 标题
     * @apiParam {String} [content] 正文
     * @apiParam {Array} [product_ids] 关联商品
     * @apiParam {Int} [sort] 排序
     * @apiParam {Int} [status] 0-禁用，1-启用
     */

    /**
     * @param Request $request
     * @param $id
     * @return string
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        $validator = new UpdateResourceArticleValidator();
        $validator->check($request->all());

        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $service = new ArticleService();
        $params = $service->secureParamForUpdate($request->all());
        $service->Update($params, $id);

        return $this->success();
    }

    /**
     * @api {delete} admin/{pin_appid}/resources/articles/{id} 删除文章
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库文章删除
     */

    /**
     * @param $id
     * @return string
     * @throws
     */
    public function destroy($id)
    {
        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $service = new ArticleService();
        $service->destroy($id);

        return $this->success();
    }
}
