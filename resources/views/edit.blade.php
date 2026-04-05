@extends('layouts.app')

@section('content')
    {{-- Reuse blade template with passing data --}}
    @include('form', [
        'task' => $task
    ])
@endsection