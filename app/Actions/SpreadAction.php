<?php

namespace App\Actions;

use App\Exceptions\BizException;
use App\Models\Spread;

class SpreadAction extends Action implements ActionInterface
{
    public function create(array $params): int
    {
        $m = new Spread();
        $m->corp_id = $params['corp_id'];
        $m->app_id = $params['app_id'];
        $m->type = $params['type'];
        $m->matter_id = $params['matter_id'];

        if (isset($params['mission_id'])) {
            $m->mission_id = $params['mission_id'];
        }
        if (isset($params['resource_id'])) {
            $m->resource_id = $params['resource_id'];
        }

        $m->seller_id = $params['seller_id'];
        $m->title = $params['title'];

        if (isset($params['image_ids'])) {
            $m->image_ids = $params['image_ids'];
        }
        $m->description = $params['description'];

        $result = $m->save();
        return $result ? $m->id : 0;
    }

    public function update(array $params, $id)
    {
        //
    }

    public function destroy($id)
    {
        $m = Spread::find($id);
        throw_unless($m, BizException::class, '对应id没有数据');

        $m->delete();
        return $m;
    }
}
