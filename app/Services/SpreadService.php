<?php

namespace App\Services;

use App\Actions\SpreadAction;
use App\Models\Mission;
use App\Models\Spread;
use App\Actions\ArticleAction;
use App\Actions\MatterAction;
use App\Exceptions\BizException;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;

class SpreadService extends Service
{
    /**
     * 创建一篇传播
     *
     * @param array $params
     * @throws
     */
    public function create(array $params)
    {
        DB::beginTransaction();
        if ($params['type'] === Spread::TYPE_MATTER) {
            // 插入文章表，取得content_ids
            $contentId = (new ArticleAction())->create($params);
            // 插入内容表，取得matter_id
            $params['content_ids'] = [(string)$contentId];
            $matterId = (new MatterAction())->create($params);
        } elseif ($params['type'] === Spread::TYPE_MISSION) {
            $result = Mission::with('Task:id,matter_id')->where('id', $params['mission_id'])->select('matter_id')->first();
            $matterId = $result->Task->matter_id;
        } elseif ($params['type'] === Spread::TYPE_RESOURCE) {
            $matterId = Resource::where('id', $params['resource_id'])->value('matter_id');
        } else {
            // 外面有Validator校验，正常不会进来
            $matterId = 0;
        }

        // 插入传播表
        $params['matter_id'] = $matterId;
        (new SpreadAction())->create($params);
        DB::commit();
    }

    /**
     * 删除一篇传播
     *
     * @param $id
     * @throws \Throwable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        // 删除传播表
        $spread = (new SpreadAction())->destroy($id);
        if ($spread->type === Spread::TYPE_MATTER) {
            // 删除内容表，获取content_ids
            $matter = (new MatterAction())->destroy($spread->matter_id);

            // 删除文章表
            $articleIds = $matter->content_ids;
            (new ArticleAction())->destroy($articleIds);
            DB::commit();
        }
    }

    /**
     * 创建传播时，过滤安全参数
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
            'content' => $params['content'] ?? '',
            'seller_id' => $params['seller_id'],
            'product_ids' => $params['product_ids'] ?? null,
            'image_ids' => $params['image_ids'] ?? null,
            'description' => $params['description'] ?? '',
            'type' => (int)$params['type'],
            'mission_id' => $params['mission_id'] ?? null,
            'resource_id' => $params['resource_id'] ?? null,
        ];

        return $params;
    }
}
