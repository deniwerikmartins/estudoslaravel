<?php

use App\Post;

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

Route::get('read', function(){

	$posts = Post::all();

	foreach ($posts as $key => $post) {
		echo $post->title;
	}

	return $posts;

});

/*Route::get('find/{id}', function($id){

	$post = Post::find($id);

	echo $post->title;

});*/

Route::get('find', function(){

	$post = Post::find(1);

	echo $post->title;

});

Route::get('findwhere', function(){

	$posts = Post::where('id', 1)->orderBy('id', 'desc')->take(1)->get();

	return $posts;
});

Route::get('findmore', function(){

	$posts = Post::findOrFail(1);

	//$posts = Post::where('users_count', '<', 50)->firstOrFail();

	return $posts;

});

Route::get('basicinsert', function(){
	$post = new Post();

	$post->title = "new orm title";
	$post->content = "new orm content";
	$post->is_admin = 0;

	$post->save();
});

Route::get('basicupdate', function(){
	$post = Post::find(1);

	$post->title = "new orm title 2";
	$post->content = "new orm content 2";
	$post->is_admin = 0;

	$post->save();
});

Route::get('create', function(){

	Post::create(['title' => 'php is the create method', 'content' => 'i am learning a lot' , 'is_admin' => 0]);
});

Route::get('update', function(){
	$post = Post::where('id', 2)->where('is_admin', 0)->update(['title' => 'new PHP title updated', 'content' => 'new php contend updated']);
});

Route::get('delete',function(){
	$post = Post::find(1);

	$post->delete();
});

Route::get('delete2', function(){
	//Post::destroy(2);
	Post::destroy([3,4]);

	//Post::where('is_admin', 0)->delete();
});

Route::get('softdelete', function(){

	Post::find(6)->delete();

});

Route::get('readsoftdelete', function(){

	// não vai trazer nada, pois foi deletado
	/*$post = Post::find(5);
	return $post;*/

	/*$post = Post::withTrashed()->where('id', 5)->get();
	return $post;*/

	/*$post = Post::onlyTrashed()->where('is_admin', 0)->get();
	return $post;*/

	$post = Post::onlyTrashed()->where('id', 5)->get();
	return $post;
});

Route::get('restore', function(){
	Post::withTrashed()->where('is_admin', 0)->restore();
});

Route::get('forcedelete', function(){
	Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});