<?php

namespace App\Services;


use App\Actions\TaskAction;
use App\Repositories\TaskRepository;

class TaskService extends Service
{
    public function getList($payload)
    {
        $repository = new TaskRepository();
        return $repository->getList($payload);
    }

    public function create($payload)
    {
//        $matterAction = new CreateMatter();
        $action = new TaskAction();
        return $action->create($payload);
    }

    public function update($id, $payload)
    {
        $action = new TaskAction();
        return $action->update($id, $payload);
    }

    public function destroy($id)
    {
        $action = new TaskAction();
        return $action->destroy($id);
    }
}