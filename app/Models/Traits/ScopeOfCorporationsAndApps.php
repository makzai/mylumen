<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

Trait ScopeOfCorporationsAndApps
{
    public function scopeOfCorp(Builder $query, $corpId)
    {
        return $query->where('corp_id', (int)$corpId);
    }

    public function scopeOfCorps(Builder $query, $corpIds)
    {
        if (!is_array($corpIds)) {
            if (is_numeric($corpIds)) {
                $corpIds = array_wrap($corpIds);
            } else {
                $corpIds = explode(',', $corpIds);
            }
        }

        $corpIds = array_map('intval', $corpIds);

        if (count($corpIds) === 1) {
            return $query->ofCorporation($corpIds[0]);
        }

        return $query->whereIn('corp_id', $corpIds);
    }

    public function scopeOfApp(Builder $query, $appId)
    {
        return $query->where('app_id', (int)$appId);
    }

    public function scopeOfApps(Builder $query, $appIds)
    {
        if (!is_array($appIds)) {
            if (is_numeric($appIds)) {
                $appIds = array_wrap($appIds);
            } else {
                $appIds = explode(',', $appIds);
            }
        }

        $appIds = array_map('intval', $appIds);

        if (count($appIds) === 1) {
            return $query->ofApp($appIds[0]);
        }

        return $query->whereIn('app_id', $appIds);
    }

    public function scopeOfCorpAndApp(Builder $query, $payload)
    {
        $payload = collect($payload);
        $corpId = $payload->get('corp_id');
        $appId = $payload->get('app_id');
        return $query->where('app_id', '=', $appId)->where('corp_id', '=', $corpId);
    }
}
