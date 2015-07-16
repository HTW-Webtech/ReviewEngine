<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::group(array('before' => 'auth'), function() {

    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/widgets', 'WidgetsController@index');
    Route::get('/dashboard/widget/{id}', 'WidgetsController@show');
    Route::post('/dashboard/widget/add', 'WidgetsController@create');

});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// API
Route::get('/widget/{id}', 'WidgetAPIController@requestWidget');
Route::post('/widget/{id}/rate/', 'WidgetAPIController@retrieveRating');
