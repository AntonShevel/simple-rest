<?php

namespace SimpleRest\Http\Controllers;

use SimpleRest\Http\Requests\CreateTaskRequest;
use SimpleRest\Models\Task;
use SimpleRest\Transformers\TaskTransformer;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::simplePaginate();
        $transformedTasks = fractal($tasks->items(), new TaskTransformer())->toArray();

        return response()->json($transformedTasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $task = (new Task())->fill($request->all());
        $task->saveOrFail();

        return response()->json(fractal($task, new TaskTransformer())->toArray(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json(fractal($task, new TaskTransformer())->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateTaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id)->fill($request->all());
        $task->saveOrFail();

        return response()->json(fractal($task, new TaskTransformer())->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Task::findOrFail($id);
        $item->delete();

        return response()->json([], 204);
    }
}
