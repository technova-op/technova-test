<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@view')->name('view');
Route::put('/home/{id}', 'HomeController@update')->name('update');

//ADMIN
Route::prefix('admin/')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('dashboard');

    //karyawan
    Route::get('/karyawan', 'AdminController@karyawan')->name('karyawan');
    Route::get('/karyawan/create', 'KaryawanController@create')->name('create-karyawan');
    Route::post('/karyawan/create', 'KaryawanController@addKaryawan')->name('post-karyawan');
    Route::get('/karyawan/{id}', 'KaryawanController@view')->name('view-karyawan');
    Route::get('/karyawan/{id}/edit', 'KaryawanController@edit')->name('edit-karyawan');
    Route::put('/karyawan/{id}/edit', 'KaryawanController@update')->name('update-karyawan');


    //task
    Route::get('/tasks', 'TaskController@index')->name('task');
    Route::get('/tasks/create', 'TaskController@create')->name('create-task');
    Route::get('/tasks/create', 'TaskController@create')->name('create-task');
    Route::post('/tasks/create', 'TaskController@addTask')->name('post-task');
    Route::get('/tasks/{id}', 'TaskController@viewTask')->name('view-task');
    Route::get('/tasks/{id}/edit', 'TaskController@editTask')->name('edit-task');
    Route::put('/tasks/{id}/edit', 'TaskController@updateTask')->name('update-task');

    Route::post('/tasks/images', 'TaskController@uploadImage')->name('task-image');

    //ajax
    Route::post('/karyawan/delete', 'AdminController@delete')->name('delete-karyawan');
    Route::delete('/tasks/delete', 'TaskController@deleteTask')->name('delete-task');
});
