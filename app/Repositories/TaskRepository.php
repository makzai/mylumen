<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/6
 * Time: 14:00
 */

namespace App\Repositories;


use App\Models\Task;

class TaskRepository extends Repository
{
    public static function getList($payload)
    {
        $payload = collect($payload);
        return Task::with('matter')->paginate();
    }
}