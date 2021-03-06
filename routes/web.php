<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------s-----------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'GuestController@index');

//email
Route::get('/auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('/auth/resend-verification', 'Auth\RegisterController@resendVerification');

// pinjam buku
Route::get('/books/{book}/borrow', 'BooksController@borrow')->name('guest.books.borrow');
Route::patch('/books/{book}/return', 'BooksController@return')->name('member.books.return');

// captcha
Route::get('/refresh-captcha', 'Auth\RegisterController@refreshCaptcha');

//settings profile
Route::get('settings/profile','SettingsController@profile')->name('profile');
Route::get('settings/profile/edit','SettingsController@editProfile')->name('profile.edit');
Route::post('settings/profile','SettingsController@updateProfile')->name('profile.update');

// setting password
Route::get('settings/password/edit','SettingsController@editpassword')->name('password.edit');
Route::post('settings/password','SettingsController@updatepassword')->name('password.update');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth', 'role:admin']], function(){
  Route::resource('authors', 'AuthorsController');
  Route::resource('books', 'BooksController');
  Route::resource('members', 'MembersController');
  Route::get('statistics', 'StatisticsController@index')->name('statistics.index');
  //export
  Route::get('export/books', 'BookExportController@export')->name('export.books');
  Route::post('export/books', 'BookExportController@exportPost')->name('export.books.post');

  //import
  Route::get('import/books', 'BookImportController@generateExcelTemplate')->name('template.books');
  Route::post('import/books', 'BookImportController@importExcel')->name('import.books.excel');
});
