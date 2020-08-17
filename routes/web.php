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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/post/{post}', 'PostController@show')->name('post');


Route::middleware('auth')->group(function () {
    Route::get('/admin', 'AdminsController@index')->name('admin.index');
    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::get('/admin/posts', 'PostController@index')->name('post.index');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');

    Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
    Route::delete('/admin/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.update');

    Route::put('/admin/users/{user}/update', 'UserController@update')->name('user.profile.update');
    Route::put('/admin/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('/admin/users/{user}/detach', 'UserController@detach')->name('user.role.detach');

    Route::delete('/admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');

    Route::get('/admin/roles', 'RoleController@index')->name('role.index');
    Route::get('/admin/permissions', 'PermissionController@index')->name('permission.index');
});

Route::middleware(['role:Admin', 'auth'])->group(function () {
    Route::get('/admin/users', 'UserController@index')->name('user.index');
});

Route::middleware(['can:view,user'])->group(function () {
    Route::get('/admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');
});
