@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-4">
        <a href="{{ route('tasks.index') }}" class="btn">Back to Task List</a>
    </div>
    <p class="mt-2 mb-4 tex-slate-700"> {{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mt-2 mb-4 tex-slate-700">{{ $task->long_description }}</p>
    @endif

    <p class="mt-2 mb-4 text-slate-700">Created at: {{ $task->created_at->diffForHumans() }} : Updated at:
        {{ $task->updated_at->diffForHumans() }}
    </p>

    <p class="mb-4">
        Status:
        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                {{ $task->completed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $task->completed ? 'Completed' : 'Incomplete' }}
        </span>
    </p>

    <div class="flex space-x-2">
        <button>
            <a href="{{ route('tasks.edit', [$task]) }}" class="btn">Edit Task</a>
        </button>

        <form action="{{ route('tasks.complete', [$task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">{{ $task->completed ? 'Mark as Incomplete' : 'Mark as Completed' }}</button>
        </form>

        <form action="{{ route('tasks.destroy', [$task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete Task</button>
        </form>
    </div>
@endsection
