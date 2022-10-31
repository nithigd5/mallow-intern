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

Route::get('/' , function (){
    return redirect('/login');
});

//Route::get('/register' , [StudentController::class , 'create']);
//
//Route::post('/register' , [StudentController::class , 'store']);

Route::get('/students' , [StudentController::class , 'index'])
    ->name('students');

Route::get('/students/{student}' , [StudentController::class , 'get']);

require_once 'auth.php';
require_once 'authenticated.php';
