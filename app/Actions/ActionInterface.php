<?php

namespace App\Actions;

interface ActionInterface
{
    public function create(array $params);

    public function update(array $params, $id);

    public function destroy($id);
}
