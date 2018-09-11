<?php

namespace App\Actions;


use App\Models\Task;

class TaskAction extends Action
{
    public function create($payload)
    {
        $task = new Task();
        $task->corp_id = $payload['corp_id'];
        $task->app_id = $payload['app_id'];
        $task->name = $payload['name'];
        $task->title = $payload['title'];
        $task->matter_id = $payload['matter_id'];
        $task->begin_at = $payload['begin_at'];
        $task->end_at = $payload['end_at'];
        $task->creator_name = $payload['creator_name'];
        $task->creator_id = $payload['creator_id'];
        $task->status = $payload['status'];
        $task->save();
        return $task->id;
    }

    public function update($id, $payload)
    {
        $task = Task::find($id);
        $task->corp_id = $payload['corp_id'];
        $task->app_id = $payload['app_id'];
        $task->name = $payload['name'];
        $task->title = $payload['title'];
        $task->matter_id = $payload['matter_id'];
        $task->begin_at = $payload['begin_at'];
        $task->end_at = $payload['end_at'];
        $task->creator_name = $payload['creator_name'];
        $task->creator_id = $payload['creator_id'];
        $task->status = $payload['status'];
        $task->save();
        return $task;
    }

    public function destroy($id)
    {
        return Task::destroy($id);
    }
}