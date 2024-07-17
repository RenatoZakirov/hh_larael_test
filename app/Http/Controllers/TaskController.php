<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showAllTasks()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $task->formatted_created_at = date('d-m-Y', strtotime($task->created_at));
            $task->formatted_deadLineDate = date('d-m-Y', strtotime($task->deadLineDate));
        }

        return response()->json($tasks);
    }

    public function addTask(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:300',
            'deadLineDate' => 'required|date_format:Y-m-d',
        ]);

        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }

    public function findTaskByDate($date)
    {
        $tasks = Task::whereDate('deadLineDate', $date)->get();

        foreach ($tasks as $task) {
            $task->formatted_created_at = date('d-m-Y', strtotime($task->created_at));
            $task->formatted_deadLineDate = date('d-m-Y', strtotime($task->deadLineDate));
        }

        return response()->json($tasks);
    }

    public function findTaskByStatus($status)
    {
        $tasks = Task::where('status', $status)->get();

        foreach ($tasks as $task) {
            $task->formatted_created_at = date('d-m-Y', strtotime($task->created_at));
            $task->formatted_deadLineDate = date('d-m-Y', strtotime($task->deadLineDate));
        }

        return response()->json($tasks);
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task, 200);
    }

    public function closeTask($id)
    {
        $task = Task::findOrFail($id);
        $task->status = true;
        $task->save();
        return response()->json($task, 200);
    }
}

