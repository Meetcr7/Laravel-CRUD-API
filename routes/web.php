<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Student;

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

Route::get('/', function () {
    return view('welcome');
});

//route for read
//Route::get('select','User@select');
Route::get('select',[User::class, 'select']);

//route for update 
//Route::match(['get','post'],'update','User@update');
//Route::put('update','Student@update');
Route::put('update',[User::class, 'update']);

//route for insert
//Route::post('insert','Student@insert');
Route::post('insert',[User::class, 'insert']);

// route for delete
Route::delete('delete',[User::class, 'Delete']);
//Route::delete('delete','Student@delete');

Route::get('get',[User::class, 'marks']);

Route::get('result',[User::class, 'result']);