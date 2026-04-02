<?php

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
Route::get('/tasks/{id}/edit', function($id) {
  return view('edit', ['task' => Task::findOrFail($id)]); 
})->name('tasks.edit');

// Details route
Route::get('/tasks/{id}', function($id) {
  // findOrFail will abort Http not found if the return val is null
  return view('show', ['task' => Task::findOrFail($id)]); 
})->name('tasks.show');

// Create api
Route::post('/tasks', function(Request $request) {
  $data = $request->validate([
    'title'             => 'required|string|max:255',
    'description'       => 'required',
    'long_description'  => 'required'
  ]);

  $task = new Task();
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();

  return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

// Edit api
Route::put('/tasks/{id}', function($id, Request $request) {
  $data = $request->validate([
    'title'             => 'required|string|max:255',
    'description'       => 'required',
    'long_description'  => 'required'
  ]);

  $task = Task::findOrFail($id);
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->save();

  return redirect()->route('tasks.show', ['id' => $task->id])
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
