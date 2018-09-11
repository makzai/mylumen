<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/6
 * Time: 20:56
 */

namespace App\Actions;


use App\Models\Store;

class StoreAction extends Action
{
    public function create($payload)
    {
        $store = new Store();
        $store->corp_id = $payload['corp_id'];
        $store->app_id = $payload['app_id'];
        $store->name = $payload['name'];
        $store->province = $payload['province'];
        $store->city = $payload['city'];
        $store->district = $payload['district'];
        $store->detail = $payload['detail'];
        $store->phone = $payload['phone'];
        $store->status = $payload['status'];
        $store->save();
        return $store;
    }

    public function update($payload, $id)
    {
        $store = Store::find($id);
        $store->corp_id = $payload['corp_id'];
        $store->app_id = $payload['app_id'];
        $store->name = $payload['name'];
        $store->province = $payload['province'];
        $store->city = $payload['city'];
        $store->district = $payload['district'];
        $store->detail = $payload['detail'];
        $store->phone = $payload['phone'];
        $store->status = $payload['status'];
        $store->save();
        return $store->id;
    }

    public function destroy($id)
    {
        return Store::destroy($id);
    }
}