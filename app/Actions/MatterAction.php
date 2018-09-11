<?php

namespace App\Actions;

use App\Exceptions\BizException;
use App\Models\Matter;

class MatterAction extends Action
{
    public function create(array $params): int
    {
        $m = new Matter();
        $m->corp_id = $params['corp_id'];
        $m->app_id = $params['app_id'];
        $m->title = $params['title'];

        if (isset($params['content_ids'])) {
            $m->content_ids = $params['content_ids'];
        }

        if (isset($params['image_ids'])) {
            $m->image_ids = $params['image_ids'];
        }

        if (isset($params['product_ids'])) {
            $m->product_ids = $params['product_ids'];
        }

        $result = $m->save();
        return $result ? $m->id : 0;
    }

    public function update(array $params, $id)
    {
        $m = Matter::find($id);
        throw_unless($m, BizException::class, '对应id没有数据');

        $paramsKey = array_keys($params);
        foreach ($m->toArray() as $k => $item) {
            if (in_array($k, $paramsKey)) {
                $m->$k = $params[$k];
            }
        }

        $m->save();
        return $m;
    }

    public function destroy($id)
    {
        $m = Matter::find($id);
        throw_unless($m, BizException::class, '对应id没有数据');

        $m->delete();
        return $m;
    }
}
