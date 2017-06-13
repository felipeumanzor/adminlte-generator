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
    return redirect('home');
});


Auth::routes();

Route::get('/home', 'HomeController@index');



Route::resource('levels', 'LevelController');

Route::resource('contents', 'ContentController');

Route::resource('files', 'FilesController');

Route::resource('users', 'UsersController');

Route::resource('ratings', 'RatingController');

Route::resource('fileComments', 'FileCommentController');

Route::resource('contentComments', 'ContentCommentController');

Route::resource('favorites', 'FavoriteController');

Route::resource('planifications', 'PlanificationController');

Route::resource('subjects', 'SubjectController');