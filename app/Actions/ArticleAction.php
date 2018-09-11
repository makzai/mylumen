<?php

namespace App\Actions;

use App\Exceptions\BizException;
use App\Models\Article;

class ArticleAction extends Action
{
    public function create(array $params)
    {
        $m = new Article();
        $m->content = $params['content'];

        $result = $m->save();
        return $result ? $m->id : 0;
    }

    public function update(array $params, $id)
    {
        $m = Article::find($id);
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
        $count = Article::destroy($id);
        throw_unless($count, BizException::class, '删除0行');

        return $count;
    }
}
