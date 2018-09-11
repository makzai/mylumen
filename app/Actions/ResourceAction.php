<?php

namespace App\Actions;

use App\Exceptions\BizException;
use App\Models\Resource;

class ResourceAction extends Action implements ActionInterface
{
    public function create(array $params): int
    {
        $m = new Resource();
        $m->corp_id = $params['corp_id'];
        $m->app_id = $params['app_id'];
        $m->type = $params['type'];
        $m->sort = $params['sort'];
        $m->matter_id = $params['matter_id'];
        $m->begin_at = $params['begin_at'];
        $m->end_at = $params['end_at'];
        $m->creator_name = $params['creator_name'];
        $m->creator_id = $params['creator_id'];
        $m->status = $params['status'];

        $result = $m->save();
        return $result ? $m->id : 0;
    }

    public function update(array $params, $id)
    {
        $m = Resource::find($id);
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
        $m = Resource::find($id);
        throw_unless($m, BizException::class, '对应id没有数据');

        $m->delete();
        return $m;
    }
}
