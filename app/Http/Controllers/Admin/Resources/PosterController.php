<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Resources\Admin\Resources\PosterResource;
use App\Http\Resources\Admin\Resources\PosterShowResource;
use App\Http\Validators\Admin\StoreResourcePosterValidator;
use App\Http\Validators\Admin\UpdateResourcePosterValidator;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use App\Services\Resources\PosterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosterController extends Controller
{

    /**
     * @api {get} admin/{pin_appid}/resources/posters 海报列表
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 获取资料库的海报列表
     * @apiParam {Int} [status] 状态筛选，0-禁用，1-启用
     * @apiParam {String} [q] 搜索关键字
     * @apiSuccess {String} capital_img 海报图片
     * @apiSuccess {Int} seller_share_count 分享员工数
     * @apiSuccess {Int} uv 浏览用户数
     * @apiSuccess {Int} status 状态，0-禁用，1-启用
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "data": [
     *            {
     *                "id": 232425,
     *                "title": "海报标题",
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
        $repo = new ResourceRepository();
        $params = $this->paramsWithPinHeader($request);
        $data = $repo->getList($params, Resource::TYPE_POSTER);

        // TODO 统计服务，图片服务

        return PosterResource::collection($data);
    }

    /**
     * @api {post} admin/{pin_appid}/resources/posters 新增海报
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库海报新增
     * @apiParam {String} title 标题
     * @apiParam {Array} image_ids 海报图片id
     * @apiParam {Int} [sort] 排序
     * @apiParam {String} creator_id 作者id
     * @apiParam {String} creator_name 作者名称
     * @apiParam {Int} status 0-禁用，1-启用
     */

    /**
     * @param Request $request
     * @return string
     * @throws
     */
    public function store(Request $request)
    {
        $validator = new StoreResourcePosterValidator();
        $validator->check($request->all());

        $service = new PosterService();
        $params = $this->paramsWithPinHeader($request);
        $params = $service->secureParamForCreate($params);
        $service->create($params);

        return $this->success();
    }

    /**
     * @api {get} admin/{pin_appid}/resources/posters/{id} 海报详情
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库海报详情
     * @apiSuccessExample {json} Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *        "id": 232425,
     *        "title": "海报标题",
     *        "creator": {
     *            "uid": 23,
     *            "name": "小明",
     *         },
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
        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $repo = new ResourceRepository();
        $info = $repo->getInfo($id, Resource::TYPE_POSTER);

        return new PosterShowResource($info);
    }

    /**
     * @api {put} admin/{pin_appid}/resources/posters/{id} 修改海报
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库海报修改
     * @apiParam {String} [title] 标题
     * @apiParam {Array} [image_ids] 海报图片id
     * @apiParam {Int} [sort] 排序
     * @apiParam {Int} [status] 0-禁用，1-启用
     */

    /**
     * @param Request $request
     * @param $id
     * @return string
     * @throws
     */
    public function update(Request $request, $id)
    {
        $validator = new UpdateResourcePosterValidator();
        $validator->check($request->all());

        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $service = new PosterService();
        $params = $service->secureParamForUpdate($request->all());
        $service->Update($params, $id);

        return $this->success();
    }

    /**
     * @api {delete} admin/{pin_appid}/resources/posters/{id} 删除海报
     * @apiGroup Admin-Resource
     * @apiUse PinCommon
     * @apiDescription 资料库海报删除
     */

    /**
     * @param $id
     * @return string
     * @throws
     */
    public function destroy($id)
    {
        // TODO 校验身份，根据corp_id/app_id/uid/id校验身份是否一致

        $service = new PosterService();
        $service->destroy($id);

        return $this->success();
    }
}
