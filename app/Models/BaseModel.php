<?php

namespace App\Models;

use App\Models\Traits\ScopeOfCorporationsAndApps;
use App\Repositories\ResourceRepository;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use ScopeOfCorporationsAndApps;
}
