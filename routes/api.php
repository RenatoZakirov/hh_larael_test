<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tasks', [TaskController::class, 'showAllTasks']);
Route::post('tasks', [TaskController::class, 'addTask']);
Route::get('tasks/date/{date}', [TaskController::class, 'findTaskByDate']);
Route::get('tasks/status/{status}', [TaskController::class, 'findTaskByStatus']);
Route::put('tasks/{id}', [TaskController::class, 'updateTask']);
Route::patch('tasks/close/{id}', [TaskController::class, 'closeTask']);