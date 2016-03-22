<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

// Route::filter('csrf-ajax', function()
// {
//     if (Session::token() != Request::header('x-csrf-token'))
//     {
//         throw new Illuminate\Session\TokenMismatchException;
//     }
// });

Route::get('/', 'FamilyController@index');
Route::post('/create-family', 'FamilyController@create_family');
Route::post('/create-unit', 'FamilyController@create_unit');
Route::get('/test', 'FamilyController@test');
Route::get('/get-tree/{id}', 'FamilyController@get_tree');
// Route::get('/catalog','FamilyController@catalog');
// Route::get('/order','FamilyController@order');
// Route::post('/sendmessage', array('before'=>'csrf-ajax', 'as'=>'order', 'uses'=>'FamilyController@sendmessage'));
// Route::get('/contact','FamilyController@contact');
