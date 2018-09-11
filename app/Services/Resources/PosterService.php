<?php

namespace App\Services\Resources;

use App\Services\Service;
use App\Actions\ArticleAction;
use App\Actions\MatterAction;
use App\Actions\ResourceAction;
use App\Exceptions\BizException;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;

class PosterService extends Service
{
    /**
     * 新增一篇海报
     *
     * @param array $params
     */
    public function create(array $params)
    {
        DB::beginTransaction();
        // 插入内容表，取得matter_id
        $matterId = (new MatterAction())->create($params);

        // 插入资料库表
        $params['matter_id'] = $matterId;
        $params['type'] = Resource::TYPE_POSTER;
        (new ResourceAction())->create($params);
        DB::commit();
    }

    /**
     * 修改一篇海报
     *
     * @param array $params
     * @param $id
     * @throws \Throwable
     */
    public function update(array $params, $id)
    {
        DB::beginTransaction();
        // 修改资料库表(sort/status)，获取到matter_id
        $resource = (new ResourceAction())->update($params, $id);
        throw_unless($resource->type == Resource::TYPE_POSTER, BizException::class, '对应id的数据不是海报');

        // 修改内容表(title/..)
        (new MatterAction())->update($params, $resource->matter_id);
        DB::commit();
    }

    /**
     * 删除一篇海报
     *
     * @param $id
     * @throws \Throwable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        // 删除资料库表，获取到matter_id
        $resource = (new ResourceAction())->destroy($id);
        throw_unless($resource->type == Resource::TYPE_POSTER, BizException::class, '对应id的数据不是海报');

        // 删除内容表
        (new MatterAction())->destroy($resource->matter_id);
        DB::commit();
    }

    /**
     * 新增海报时，过滤安全参数
     *
     * @param array $params
     * @return array
     */
    public function secureParamForCreate(array $params)
    {
        $params = [
            'corp_id' => $params['corp_id'],
            'app_id' => $params['app_id'],
            'title' => $params['title'],
            'image_ids' => $params['image_ids'],
            'sort' => $params['sort'] ?? 0,
            'begin_at' => null,
            'end_at' => null,
            'creator_name' => $params['creator_name'],
            'creator_id' => $params['creator_id'],
            'status' => $params['status'],
        ];

        return $params;
    }

    /**
     * 修改海报时，过滤安全参数
     *
     * @param array $params
     * @return array
     */
    public function secureParamForUpdate(array $params)
    {
        return collect($params)->only([
            'title',
            'image_ids',
            'sort',
            'status',
        ])->toArray();
    }
}
