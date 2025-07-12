@extends('layouts.app')

@section('title', 'List of task')

@section('content')
<nav class="mb-4">
    <button><a href="{{ route('tasks.create') }}" class="btn">Create New Task</a></button>
</nav>
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>{{ $task->title}}</a>
        </div>

    @empty
        <div>There is no tasks </div>
    @endforelse

    @if ($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
