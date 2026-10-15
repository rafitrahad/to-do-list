<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('searchValue');
        $tasks = Task::where('title', 'like', '%' . $search . '%')->paginate(5);
        return view('index', compact('tasks'));
    }



    public function store(Request $request)
    {
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('editTask', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function s(Request $request)
    {
        $searchTerm = $request->input('searchValue');
        $tasks = Task::where('title', 'like', '%' . $searchTerm . '%')->get();

        return view('taskView', compact('tasks'));
    }

    public function restoreView()
    {
        $tasks = Task::onlyTrashed()->paginate(5);
        return view('taskView', compact('tasks'));
    }
    public function restoreTask($id)
    {
        // dd("restore route");
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('tasks.index')->with('success', 'Task restored successfully.');
    }
}
