<?php

namespace App\Repositories;

use App\Exceptions\BizException;
use App\Models\Resource;
use App\Models\Spread;

class SpreadRepository extends Repository
{
    /**
     * 查询传播列表
     *
     * @param array $params
     * @return mixed
     */
    public function getList(array $params)
    {
        $params = collect($params);
        $perPage = $this->securePageSize($params->get('per_page', 0));

        $result = Spread::ofCorpAndApp($params)
            ->when($params->has('seller_id'), function ($query) use ($params) {
                return $query->where('seller_id', $params->get('seller_id'));
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->appends($params->forget(['corp_id', 'app_id'])->all());

        return $result;
    }

    /**
     * 获取传播详情
     *
     * @param Int $id
     * @return mixed
     * @throws \Throwable
     */
    public function getInfo($id)
    {
        $info = Spread::where('id', $id)->first();
        throw_unless($info, BizException::class, '对应id没有数据');

        return $info;
    }
}
