<?php

namespace App\Repositories;

class Repository
{
    const MAX_PAGE_SIZE = 9999;

    public function securePageSize($perPage)
    {
        $perPage = (int)$perPage;
        return !$perPage || $perPage > ResourceRepository::MAX_PAGE_SIZE ? ResourceRepository::MAX_PAGE_SIZE : $perPage;
    }
}
