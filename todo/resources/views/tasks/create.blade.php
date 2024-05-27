<!-- resources/views/tasks/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline">
        </div>
        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="alacsony">Alacsony</option>
                <option value="közepes">Közepes</option>
                <option value="magas">Magas</option>
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
