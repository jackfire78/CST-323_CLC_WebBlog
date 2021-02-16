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

//default route. Return to main page
Route::get('/', function () {
    return view('showHomePage');
});
//default route. Return to main page
Route::get('/Home', function () {
	return view('showHomePage');
});
//Route to login page
Route::get('/Login', function () {
	return view('showLogin');
});
//Route to register page
Route::get('/Register', function () {
	return view('showRegister');
});
//Route to blog submit page
Route::get('/BlogSubmit', function () {
	return view('BlogSubmit');
});
//Route to blog search page
Route::get('/BlogSearch', function () {
	return view('BlogSearch');
});

//Route to page showing all of current logged in user's blogs
Route::get('/Logout', 'LoginController@logoutUser');
//Login and Register post routes
Route::post('login', 'LoginController@authenticate');
Route::post('register', 'RegistrationController@createUser');
//Blog post routes	
Route::post('addBlog', 'BlogController@addBlog');
Route::post('searchBlogs', 'BlogController@searchBlogs');
Route::post('PostEditPage','BlogController@getPost');
Route::post('editPost', 'BlogController@editPost');
Route::post('deletePost', 'BlogController@deletePost');
//Route to page showing all of current logged in user's blogs
Route::get('/MyBlogs', 'BlogController@myBlogs');

