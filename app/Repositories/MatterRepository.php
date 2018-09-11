<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Matter;
use Illuminate\Support\Collection;

class MatterRepository extends Repository
{
    public function getFullInfo($id)
    {
        $matter = Matter::find($id);

        if (is_array($matter->product_ids) && count($matter->product_ids) > 0) {
            // 关联商品
        }

        if (is_array($matter->image_ids) && count($matter->image_ids) > 0) {
            // 关联图片
        }

        if (is_array($matter->content_ids) && count($matter->content_ids) > 0) {
            // 关联文章
            $article = Article::select('id', 'content')->withTrashed()->find($matter->content_ids);
            $matter->setRelation('article', $article);
        }

        return $matter;
    }
}
