<?php

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
    return view('index');
});

Route::get('/next', function () {
    return view('index2');
});

Route::get('/next2', function() {
    return view('index3');
});

Route::get('/todo', function() {
    return view('todo');
});

Route::get('/events', function() {
    return view('events');
});

Route::get('/components', function() {
    return view('components');
});