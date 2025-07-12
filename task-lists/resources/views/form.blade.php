@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">
        @csrf
        @if (isset($task))
            @method('PUT')
        @endif
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title ?? '') }}" required>
        </div>
        <div class="mb-4">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5"
                required>{{ old('description', $task->description ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea id="long_description" name="long_description"
                rows="10">{{ old('long_description', $task->long_description ?? '') }}</textarea>
        </div>
        <div class="flex space-x-2 items-center">
            <button type="submit" class="btn">{{ isset($task) ? 'Update Task' : 'Create Task' }}</button>
            <button class="btn"><a href="{{ route('tasks.index') }}">Cancel</a></button>
        </div>
    </form>
@endsection
