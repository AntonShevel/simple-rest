<?php

namespace SimpleRest\Transformers;

use SimpleRest\Models\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    public function transform(Task $task)
    {
        return [
            'id' => $task->id,
            'description' => $task->description,
            'priority' => ucfirst($task->priority)
        ];
    }
}
