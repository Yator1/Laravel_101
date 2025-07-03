@extends('layouts.app')

@section('title', 'List of task')

@section('content')
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">{{ $task->title}}</a>
        </div>

    @empty
        <div>There is no tasks </div>

    @endforelse
@endsection