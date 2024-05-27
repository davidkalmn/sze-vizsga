<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>

    <!-- Profile Management Button -->
    <a href="{{ route('profile.show') }}" class="btn btn-secondary">Profile Management</a>

    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-4">
        <div class="input-group mb-2">
            <input type="text" name="search" class="form-control" placeholder="Search tasks by title" value="{{ request('search') }}">
        </div>
        <div class="input-group mb-2">
            <select name="priority" class="form-control">
                <option value="">All Priorities</option>
                <option value="alacsony" {{ request('priority') == 'alacsony' ? 'selected' : '' }}>Alacsony</option>
                <option value="közepes" {{ request('priority') == 'közepes' ? 'selected' : '' }}>Közepes</option>
                <option value="magas" {{ request('priority') == 'magas' ? 'selected' : '' }}>Magas</option>
            </select>
        </div>
        <div class="input-group-append mb-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Sorting Buttons -->
    <div class="mb-4">
        <a href="{{ route('tasks.index', array_merge(request()->query(), ['sort' => 'asc'])) }}" class="btn btn-secondary">Sort by Priority Ascending</a>
        <a href="{{ route('tasks.index', array_merge(request()->query(), ['sort' => 'desc'])) }}" class="btn btn-secondary">Sort by Priority Descending</a>
    </div>

    <h2>Incomplete Tasks</h2>
    <ul>
        @foreach ($incompleteTasks as $task)
            <li>
                {{ $task->title }} - {{ $task->deadline }} - {{ $task->priority }}
                <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Complete</button>
                </form>
                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Completed Tasks</h2>
    <ul>
        @foreach ($completedTasks as $task)
            <li>
                {{ $task->title }} - {{ $task->deadline }} - {{ $task->priority }}
                <span>Completed</span>
                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
