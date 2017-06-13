<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('levels', 'LevelAPIController');

Route::resource('contents', 'ContentAPIController');

Route::resource('files', 'FilesAPIController');

Route::resource('users', 'UsersAPIController');

Route::resource('ratings', 'RatingAPIController');

Route::resource('file_comments', 'FileCommentAPIController');

Route::resource('content_comments', 'ContentCommentAPIController');

Route::resource('favorites', 'FavoriteAPIController');

Route::resource('planifications', 'PlanificationAPIController');

Route::resource('subjects', 'SubjectAPIController');