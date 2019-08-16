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

Route::get('/', function () {

    return view('welcome');
});

Route::Resource('contato','ContatoController');

Route::post('teste/{id}', 'ContatoController@teste');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/user/roles', ['middleware' => ['role','auth', 'web', 'IsAdmin'], function(){

	return 'middleware role';

}]);

Route::get('admin', 'AdminController@index');