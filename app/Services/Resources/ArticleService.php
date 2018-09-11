<?php

namespace App\Services\Resources;

use App\Services\Service;
use App\Actions\ArticleAction;
use App\Actions\MatterAction;
use App\Actions\ResourceAction;
use App\Exceptions\BizException;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;

class ArticleService extends Service
{
    /**
     * 新增一篇文章
     *
     * @param array $params
     */
    public function create(array $params)
    {
        DB::beginTransaction();
        // 插入文章表，取得content_ids
        $contentId = (new ArticleAction())->create($params);

        // 插入内容表，取得matter_id
        $params['content_ids'] = [(string)$contentId];
        $matterId = (new MatterAction())->create($params);

        // 插入资料库表
        $params['matter_id'] = $matterId;
        $params['type'] = Resource::TYPE_ARTICLE;
        (new ResourceAction())->create($params);
        DB::commit();
    }

    /**
     * 修改一篇文章
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
        throw_unless($resource->type == Resource::TYPE_ARTICLE, BizException::class, '对应id的数据不是文章');

        // 修改内容表(title/product_ids)，获取content_ids
        $matter = (new MatterAction())->update($params, $resource->matter_id);

        // 修改文章表
        $articleId = $matter->content_ids[0];
        (new ArticleAction())->update($params, $articleId);
        DB::commit();
    }

    /**
     * 删除一篇文章
     *
     * @param $id
     * @throws \Throwable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        // 删除资料库表，获取到matter_id
        $resource = (new ResourceAction())->destroy($id);
        throw_unless($resource->type == Resource::TYPE_ARTICLE, BizException::class, '对应id的数据不是文章');

        // 删除内容表，获取content_ids
        $matter = (new MatterAction())->destroy($resource->matter_id);

        // 删除文章表
        $articleIds = $matter->content_ids;
        (new ArticleAction())->destroy($articleIds);
        DB::commit();
    }

    /**
     * 新增文章时，过滤安全参数
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
            'content' => $params['content'],
            'product_ids' => $params['product_ids'] ?? null,
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
     * 修改文章时，过滤安全参数
     *
     * @param array $params
     * @return array
     */
    public function secureParamForUpdate(array $params)
    {
        return collect($params)->only([
            'title',
            'content',
            'product_ids',
            'sort',
            'status',
        ])->toArray();
    }
}
