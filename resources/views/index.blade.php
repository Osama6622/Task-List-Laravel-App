@extends('layouts.app')

@section('title', 'The List of tasks')

@section('content')
    <div>
        {{-- @if (count($tasks))
        <div>There are tasks!</div>
    @else
        <div>There are no Tasks!</div>
    @endif --}}

        @forelse ($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
            </div>
        @empty
            <div>There are no Tasks!</div>
        @endforelse
    </div>
@endsection
