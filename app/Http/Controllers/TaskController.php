<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(TaskStoreRequest $request): TaskResource
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    public function show(Task $task): TaskResource
    {
        return new TaskResource($task->load('project'));
    }

    public function update(TaskStoreRequest $request, Task $task): TaskResource
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task): TaskResource
    {
        $task->delete();

        return new TaskResource($task);
    }
}
