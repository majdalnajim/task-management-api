<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;

// Route::apiResource("tasks",TaskController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource("tasks",TaskController::class);
});
Route::middleware('auth:sanctum')->get("/me",function(){
    return auth()->user();
});
Route::get("completed-tasks",[TaskController::class,"completed"]);
Route::get("panding-tasks",[TaskController::class,"unCompleted"]);
Route::get("search",[TaskController::class,"search"]);
Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);
Route::post("logout",[AuthController::class,"logout"])->middleware('auth:sanctum');
Route::post("logout-all",[AuthController::class,"logoutAllDevice"])->middleware('auth:sanctum');
