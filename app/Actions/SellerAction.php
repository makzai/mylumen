<?php

namespace App\Actions;


use App\Models\Seller;

class SellerAction extends Action
{
    public function create($payload)
    {
        $seller = new Seller();
        $seller->corp_id = $payload['corp_id'];
        $seller->app_id = $payload['app_id'];
        $seller->store_id = $payload['store_id'];
        $seller->account = $payload['account'];
        $seller->name = $payload['name'];
        $seller->phone = $payload['phone'];
        $seller->wechat = $payload['wechat'];
        $seller->role = $payload['role'];
        $seller->job_title = $payload['job_title'];
        $seller->status = $payload['status'];
        $seller->save();
        return $seller;
    }

    public function update($payload, $id)
    {
        $seller = Seller::find($id);
        $seller->corp_id = $payload['corp_id'];
        $seller->app_id = $payload['app_id'];
        $seller->store_id = $payload['store_id'];
        $seller->account = $payload['account'];
        $seller->name = $payload['name'];
        $seller->phone = $payload['phone'];
        $seller->wechat = $payload['wechat'];
        $seller->role = $payload['role'];
        $seller->job_title = $payload['job_title'];
        $seller->status = $payload['status'];
        $seller->save();
        return $seller->id;
    }

    public function destroy($id)
    {
        return Seller::destroy($id);
    }
}