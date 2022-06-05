<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $task = new Task;
    $task->name =$request->name;
    $task->save();

    return redirect('/');
 
    // Create The Task...
});
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
 
    return view('tasks', [
        'tasks' => $tasks
    ]);
});


Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
 
    return redirect('/');
});
