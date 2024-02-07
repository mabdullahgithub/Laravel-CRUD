<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 

// Route::get('list/{id?}', [StudentController::class, 'list']);
// Route::put('update/{id}', [StudentController::class, 'update'])->middleware('checkStudentExists:id');
// Route::delete('delete/{id}', [StudentController::class, 'delete']);

Route::middleware(['checkStudentExists'])->group(function () {
    Route::put('/update/{id}', [StudentController::class, 'update']);
    Route::delete('/delete/{id}', [StudentController::class, 'delete']);
    Route::get('/list/{id?}', [StudentController::class, 'list']);
});
Route::post('/logout', [Auth::class, 'logout'])->middleware('auth');
Route::post('/signup', [Auth::class, 'signup']);
Route::post('/login', [Auth::class, 'login']);
Route::get('search/{name}', [StudentController::class, 'search'])->middleware('checkStudentExistsByName');
Route::post('add', [StudentController::class, 'add']);


Route::Get('test', [Auth::class, 'test'])->middleware('auth');
Route::Get('searchs/{id}', [Auth::class, 'searchs'])->middleware('auth');