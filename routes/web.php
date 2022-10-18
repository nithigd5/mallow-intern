<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/' , function () {
    return view('register');
});

Route::post('/register' , [StudentController::class , 'create']);

Route::get('/students' , [StudentController::class , 'index'])
    ->name('students');

Route::get('/students/{student}' , [StudentController::class , 'get']);
