<?php

namespace App\Services;


use App\Actions\SellerAction;
use App\Exceptions\BizException;
use App\Models\Seller;
use App\Repositories\SellerRepository;

class SellerService extends Service
{
    public function getList($payload)
    {
        $repository = new SellerRepository();
        return $repository->getList($payload);
    }

    /**
     * @throws
     */
    public function create($payload)
    {
        $store = Seller::OfCorpAndApp($payload)
            ->where('account', '=', $payload['account'])
            ->first();

        throw_unless(empty($store), BizException::class, '该手机号已被注册');

        $action = new SellerAction();
        return $action->create($payload);
    }

    /**
     * @throws
     */
    public function update($payload, $id)
    {
        $store = Seller::OfCorpAndApp($payload)
            ->where('account', '=', $payload['account'])
            ->where('id', '!=', $id)
            ->first();

        throw_unless(empty($store), BizException::class, '该手机号已被注册');

        $action = new SellerAction();
        return $action->update($payload, $id);
    }

    public function destroy($id)
    {
        $action = new SellerAction();
        return $action->destroy($id);
    }
}