<?php

namespace App\Repositories;

use App\Exceptions\BizException;
use App\Models\Resource;

class ResourceRepository extends Repository
{
    /**
     * 查询资料列表
     *
     * @param array $params
     * @param Int $type 文章/海报/商品
     * @return mixed
     */
    public function getList(array $params, $type)
    {
        $params = collect($params);
        $perPage = $this->securePageSize($params->get('per_page', 0));

        $result = Resource::ofCorpAndApp($params)
            ->with('matter')
            ->where('type', $type)
            ->when($params->has('status'), function ($query) use ($params) {
                return $query->where('status', $params->get('status'));
            })
            ->when($params->has('q'), function ($query) use ($params) {
                $q = $params->get('q');
                return $query->whereHas('matter', function ($query) use ($q) {
                    return $query->where('title', 'like', "%{$q}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->appends($params->forget(['corp_id', 'app_id'])->all());

        return $result;
    }

    /**
     * 获取资料详情
     *
     * @param Int $id
     * @param Int $type 文章/海报/商品
     * @return mixed
     * @throws \Throwable
     */
    public function getInfo($id, Int $type)
    {
        $info = Resource::where('id', $id)->where('type', $type)->first();
        throw_unless($info, BizException::class, '对应id没有数据');

        $matterRepo = new MatterRepository();
        $matter = $matterRepo->getFullInfo($info->matter_id);
        $info->setRelation('matter', $matter);

        return $info;
    }
}
