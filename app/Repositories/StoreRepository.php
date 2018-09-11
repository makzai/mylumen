<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/6
 * Time: 20:54
 */

namespace App\Repositories;


use App\Models\Store;

class StoreRepository extends Repository
{
    public function getList($payload)
    {
        $payload = collect($payload);
        $perPage = $this->securePageSize($payload->get('per_page', 0));

        return Store::OfCorpAndApp($payload)
            ->oldest()
            ->paginate($perPage)
            ->appends($payload->forget(['corp_id', 'app_id', 'pin_uid'])->all());
    }
}