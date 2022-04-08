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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('', function () {
    return view('page.index');
});

Route::get('about-me', function () {
    return view('page.about-me');
});
Route::get('admin-index', function () {
    return view('page.admin-index');
});
Route::get('blog', function () {
    return view('page.blogs.index');
});
Route::get('custorm', function () {
    return view('page.custorms.index');
});
Route::get('categories', function () {
    return view('page.categories.index');
});
Route::get('admins', function () {
    return view('page.admins.index');
});

Route::get('login', function () {
    return view('page.login');
});
Route::get('signup', function () {
    return view('page.signup');
});
Route::get('post', function () {
    return view('page.post');
});
Route::get('detail', function () {
    return view('page.detail');
});