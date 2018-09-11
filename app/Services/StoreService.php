<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/6
 * Time: 20:52
 */

namespace App\Services;


use App\Actions\StoreAction;
use App\Exceptions\BizException;
use App\Models\Store;
use App\Repositories\StoreRepository;

class StoreService extends Service
{
    public function getList($payload)
    {
        $repository = new StoreRepository();
        return $repository->getList($payload);
    }

    /**
     * @throws
     */
    public function create($payload)
    {
        $store = Store::OfCorpAndApp($payload)
            ->where('name', '=', $payload['name'])
            ->first();

        throw_unless(empty($store), BizException::class, '门店已存在');

        $action = new StoreAction();
        return $action->create($payload);
    }

    /**
     * @throws
     */
    public function update($payload, $id)
    {
        $store = Store::OfCorpAndApp($payload)
            ->where('name', '=', $payload['name'])
            ->where('id', '!=', $id)
            ->first();

        throw_unless(empty($store), BizException::class, '门店已存在');

        $action = new StoreAction();
        return $action->update($payload, $id);
    }

    public function destroy($id)
    {
        $action = new StoreAction();
        return $action->destroy($id);
    }
}