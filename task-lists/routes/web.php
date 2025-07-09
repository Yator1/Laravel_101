<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Prompts\Concerns\Fallback;


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{id}', function ($id)  {
    return view('show', ['task' => Task::findOrFail($id)]);
})->name('tasks.show');

// Route::post('/tasks', function () {
//     // Logic to create a new task
//     return redirect()->route('tasks.index');
// })->name('tasks.store');

Route::post('/tasks', function (Request $request) {
    // Logic to create a new task
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'long_description' => 'nullable|string',
        // 'completed' => 'boolean',
    ]);

    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'] ?? null;
    // $task->completed = $request->boolean('completed', false); // Default to false

    $task->save();
    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::fallback(function () {
    return '404 Not Found';
});
