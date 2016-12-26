<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); // ya define la ruta predefinida de login y registro.

Route::group(['middleware' => 'auth'], function() {
	Route::get('/home', function () {
		return view('home');
	});
    Route::group(['middleware' => 'type:Admin'], function () {
        Route::get('/categories/create', 'CategoriesController@create')->name('createCategory');

    });

    Route::get('/notes', 'NotesController@index')->name('indexNote');
    Route::get('/notes/create', 'NotesController@create')->name('createNote');
	Route::post('/notes/store','NotesController@store')->name('storeNote');
    Route::get('/notes/{id}', 'NotesController@view')->name('viewNote'); //->middleware('show.note'); //RESTRINGE LA NOTA SOLO PARA EL PARA EL DUEÑO
	Route::delete('/notes/{id}', 'NotesController@destroy')->name('destroyNote');
	Route::get('/notes/{id}/edit', 'NotesController@edit')->name('editNote');
	Route::put('/notes/{id}/edit', 'NotesController@update')->name('updateNote');

    Route::get('/categories', 'CategoriesController@index')->name('indexCategory');
    Route::post('/categories/store', 'CategoriesController@store')->name('storeCategory');
    Route::delete('/categories/{id}', 'CategoriesController@destroy')->name('destroyCategory');
    Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('editCategory');
    Route::put('/categories/{id}', 'CategoriesController@update')->name('updateCategory');
    Route::get('/categories/{id}', 'CategoriesController@view')->name('viewCategory');

    Route::get('/users/profile', 'UsersController@profile')->name('users.profile');
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::put('profile/comments/{id}/restore', 'CommentsController@restore')->name('comments.restore');

    Route::resource('comments','CommentsController');

    Route::get('/deleteimg', 'UsersController@deleteImg')->name('deleteimg');
	
});



