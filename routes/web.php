<?php

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

//Route::get('/', 'GuzzleController@index');

Route::get('/', 'Users\User\HomeController@index');

Route::get('/job/{job}', 'Users\User\HomeController@show');

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

Route::get('/home', 'Users\User\HomeController@home')->name('home');
Route::resource('/profile', 'Users\User\ProfileController');
Route::post('/apply', 'Users\User\ApplicationController@apply')->name('apply');
Route::any('/search', 'Users\User\HomeController@search')->name('search');

// Admin routes
Route::prefix('admin')->group(function(){
    Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/users/{user}', 'Users\Admin\AdminController@show_user')->name('admin.user');
    Route::post('/users/{user}', 'Users\Admin\AdminController@destroy_user')->name('admin.deuser');

    Route::resource('/category', 'Users\Admin\CategoryController');
});


// Client routes
Route::prefix('client')->group(function(){
    Route::get('/', 'Users\Client\ClientController@index')->name('client.dashboard');
    Route::get('/login', 'Auth\ClientLoginController@showLoginForm')->name('client.login');
    Route::post('/login', 'Auth\ClientLoginController@login')->name('client.login.submit');
    Route::get('/register', 'Auth\ClientRegisterController@showRegisterForm')->name('client.register');
    Route::post('/register', 'Auth\ClientRegisterController@register')->name('client.register.submit');

    Route::resource('/jobs', 'Users\Client\JobsController');
    Route::post('/jobs/publish', 'Users\Client\JobsController@publish')->name('job.publish');
    Route::post('/jobs/unpublish', 'Users\Client\JobsController@unpublish')->name('job.unpublish');

    //Route::resource('/applications', 'Users\Client\ViewApplicationsController');

    Route::get('/applications', 'Users\Client\ViewApplicationsController@index');

    Route::get('/applications/{job}', 'Users\Client\ViewApplicationsController@show');

    Route::get('/applications/view_applicant/{application}', 'Users\Client\ViewApplicationsController@view_applicant');

    Route::resource('/profile', 'Users\Client\ProfileController');
});