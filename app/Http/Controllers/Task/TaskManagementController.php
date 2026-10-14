<?php

namespace App\Http\Controllers\Task;


use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }


    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('task.index');
    }

    public function destroy(string $id)
    {
        // $task = Task::where('id', $id)->first();
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Delete Successfull');
    }


    public function edit($id)
    {

        $task = Task::find($id);

        // dd($task);

        return view('tasks.edit', compact('task'));
    }
    public function toSearch(Request $request)
    {

        $tasks = Task::find($request->title);

        // dd($task);

        return view('tasks.index', compact('tasks'));
    }


    public function update(Request $request, string $id)
    {

        //$task = Task::find($id);
        // dd($task);

        Task::where('id', $id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status
            ]);

        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function search($id) {}
}
