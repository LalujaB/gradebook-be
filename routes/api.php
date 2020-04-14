<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/login','Auth\LoginController@authenticate');

Route::post('/register', 'Auth\RegisterController@register');

Route::middleware('jwt')->resource('diaries', 'DiaryController');

Route::middleware('jwt')->post('/diaries/{id}/comments', 'DiaryController@commentStore');

Route::middleware('jwt')->post('/diaries/{id}/students', 'DiaryController@studentStore');

Route::middleware('jwt')->resource('professors','ProfessorController');

Route::middleware('jwt')->resource('comments','CommentController');

Route::middleware('jwt')->get('/users/{id}', 'UserController@show');

Route::get('/diaries/my-diary/{id}', 'DiaryController@myDiary');

Route::get('/search', 'DiaryController@search');