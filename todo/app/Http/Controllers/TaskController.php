<?php
// app/Http/Controllers/TaskController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('sort')) {
            $direction = $request->sort == 'asc' ? 'asc' : 'desc';
            $query->orderBy('priority', $direction);
        }

        $incompleteTasks = $query->where('status', false)->get();
        $completedTasks = $query->where('status', true)->get();

        return view('tasks.index', compact('incompleteTasks', 'completedTasks'));
    }
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'priority' => 'required|string|in:alacsony,közepes,magas',
        ]);

        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'deadline' => $request->deadline,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'priority' => 'required|string|in:alacsony,közepes,magas',
        ]);

        $task->update([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->update(['status' => true]);

        return redirect()->route('tasks.index')->with('success', 'Task marked as complete.');
    }
}
