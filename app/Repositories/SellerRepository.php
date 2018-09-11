<?php

namespace App\Repositories;


use App\Models\Seller;

class SellerRepository extends Repository
{
    public function getList($payload)
    {
        $payload = collect($payload);
        $perPage = $this->securePageSize($payload->get('per_page', 0));

        return Seller::OfCorpAndApp($payload)
            ->oldest()
            ->paginate($perPage)
            ->appends($payload->forget(['corp_id', 'app_id', 'pin_uid'])->all());
    }
}