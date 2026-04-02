@extends('layouts.app')

@section('title', 'Add Task')

@section('style')
    <style>
        .error-message {
            color: red;
            font-size: .8rem;
            margin: 6px 0
        }
    </style>
@endsection


@section('content')
    <form action="{{ route('tasks.store')}}" method="POST">
        {{-- directive csrf is used to prevent cross-site request forgery.
            csrf -> will generate a hidden input field with a token that is used to verify the request --}}
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10">{{ old('long_description') }}</textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit">Add Task</button>
        </div>
    </form>

@endsection