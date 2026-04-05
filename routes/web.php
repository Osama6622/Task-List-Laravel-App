<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
  return redirect()->route('tasks.index');
});

// List route
Route::get('/tasks', function () { // to access variables outside the annonymouse func use($varaibel)
  return view('index', [
    'tasks' => Task::latest()->get(),
  ]);
})->name('tasks.index');

// Create Route
Route::view('tasks/create', 'create')->name('tasks.create');

// edit route 
Route::get('/tasks/{task}/edit', function(Task $task) {
  return view('edit', [
    'task' => $task
  ]); 
})->name('tasks.edit');

// Details route
Route::get('/tasks/{task}', function(Task $task) {
  // findOrFail will abort Http not found if the return val is null
  return view('show', [
    'task' => $task
  ]); 
})->name('tasks.show');

// Create api
Route::post('/tasks', function(TaskRequest $request) {
  $task = Task::create($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Edit api
Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
  // $data = $request->validated();

  // $task->title = $data['title'];
  // $task->description = $data['description'];
  // $task->long_description = $data['long_description'];
  // $task->save();

  $task->update($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task Updated successfully!');
})->name('tasks.update');










// Route::get('/hello', function () {
//   return 'Hello';
// })->name('hello'); // route name

// Redirect
// Route::get('/hallo', function () {
//   return redirect()->route('hello'); // Using route name
// });

// Route with dynamic parameter
// Route::get('/greet/{name}', function ($name) {
//   return 'Hello ' . $name . '!';
// });

// 404 Route
Route::fallback(function () {
  return 'Still got somewhere!';
});
