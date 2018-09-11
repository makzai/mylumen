<?php

namespace App\Services\Resources;

use App\Services\Service;
use App\Actions\ArticleAction;
use App\Actions\MatterAction;
use App\Actions\ResourceAction;
use App\Exceptions\BizException;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;

class ProductService extends Service
{
    public function getJoinedProductIds($corpId, $appId)
    {
        $result = Resource::ofCorp($corpId)->ofApp($appId)
            ->with('matter:id,product_ids')
            ->where('type', Resource::TYPE_PRODUCT)
            ->select('matter_id')
            ->get();

        return $result->pluck('matter')->pluck('product_ids')->flatten()->filter()->values();
    }

    /**
     * 删除一个商品
     *
     * @param $id
     * @throws \Throwable
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        // 删除资料库表，获取到matter_id
        $resource = (new ResourceAction())->destroy($id);

        // TODO 在这里才判断记录的类型有点晚了，要依赖事务回滚，不合理
        throw_unless($resource->type == Resource::TYPE_PRODUCT, BizException::class, '对应id的数据不是商品');

        // 删除内容表
        (new MatterAction())->destroy($resource->matter_id);
        DB::commit();
    }
}
