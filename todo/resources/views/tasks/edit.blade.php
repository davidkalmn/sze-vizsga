<!-- resources/views/tasks/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $task->title }}" required>
        </div>
        <div>
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" value="{{ $task->deadline }}">
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="alacsony" {{ $task->priority == 'alacsony' ? 'selected' : '' }}>Alacsony</option>
                <option value="közepes" {{ $task->priority == 'közepes' ? 'selected' : '' }}>Közepes</option>
                <option value="magas" {{ $task->priority == 'magas' ? 'selected' : '' }}>Magas</option>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
