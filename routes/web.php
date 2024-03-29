<?php

use App\Post;
use App\User;
use App\Photo;
use App\Tag;
use App\Country;
use App\Contato;
use App\Telefone;

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

//com autenticação
Route::get('/admin/user/roles', ['middleware' => ['role','auth', 'web', 'IsAdmin'], function(){

	return 'middleware role';

}]);

// sem autenticação
/*Route::get('/admin/user/roles', function(){

	return 'middleware role';

});*/

////////////////////////////////////////////////////////////////////////////////////////

// BEST ANSWER
Route::group(['prefix' => 'admina',  'middleware' => 'auth'], function()
{
    Route::get('dashboard', function() {} );
});


// To add more than 1 middleware
Route::group([
        'prefix'     => 'admina',
        'middleware' => [
            'auth',
            'anotherMiddleware',
            'yetAnotherMiddleware',
        ],
    ], function() {
        
       Route::get('dashboard', function() {} );
});

// USAR ESTA SOLUÇÃO
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/c', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});

Route::get('admina/profile', ['middleware' => 'auth', function () {
    //
}]);

Route::get('/a', ['middleware' => ['first', 'second'], function () {
    //
}]);

Route::get('/b', function () {
    //
})->middleware(['first', 'second']);

Route::get('admina/profilea', ['middleware' => FooMiddleware::class, function () {
    //
}]);

Route::group(['middleware' => ['web']], function () {
    //
});

//////////////////////////////////////////////////////////////////////////////////////
 
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

// 1 to 1 relationship
Route::get('user/{id}/post', function($id){
	return User::find($id)->post;
});


// 1 to 1 inverse relationship
Route::get('post/{id}/user', function($id){
	return Post::find($id)->user->name;
});

// 1 to many relationship
Route::get('posts', function(){
	$user = User::find(1);

	foreach ($user->posts as $post) {
		echo $post->title;
	}
});

//many to many ralationship
Route::get('user/{id}/role',function($id){
	/*$user = User::find($id);
	$roles = $user->roles;
	foreach ($user->roles as $role) {
		return $role->name;
	}*/

	$user = User::find($id)->roles()->orderBy('id','desc')->get();

	return $user;

});

// accessing the intermediate table / pivot table
Route::get('user/pivot',function(){

	$user = User::find(1);

	foreach ($user->roles as $role) {
		echo $role->pivot->created_at;
		//echo $role->pivot->updated_at;
		//return $role->pivot;
	}

});

// accessing the intermediate table / pivot table 2
Route::get('user/country', function(){
	$country = Country::find(4);

	foreach ($country->posts as $post) {
		return $post->title;
	}
});

// polymorphic relations 

Route::get('user/photos', function(){
	$user = User::find(1);

	foreach ($user->photos as $photo) {
		return $photo;
	}	
});

Route::get('post/{id}/photos', function($id){
	$post = Post::find($id);

	foreach ($post->photos as $photo) {
		echo $photo->path . "<br>";
	}	
});

Route::get('photo/{id}/post', function($id){

	$photo = Photo::findOrFail($id);

	
	return $photo->imageable;

	//$imageable = $photo->imageable_id;
});


//polymorphic many to many
Route::get('post/tag', function(){
	$post = Post::find(1);

	foreach ($post->tags as $tag) {

		echo $tag->name;
	}
});

Route::get('tag/post', function(){
	$tag = Tag::find(2);

	foreach ($tag->posts as $post) {
		echo $post->title;
		
	}
});


/////
Route::get('getuser',function(){
	$users = User::where(['country_id' => null, 'email' => 'fulano@tal.com'])->get();

	foreach ($users as $key => $user) {
		echo $user->name;
	}

	/*$posts = Post::where('id', 1)->orderBy('id', 'desc')->take(1)->get();

	return $posts;*/
});

Route::get('getcontatoswithtelefone', function(){
	/*$contatos = Contato::all();
	//return $contatos;
	
	foreach ($contatos as $contato) {
		echo ($contato->telefones);
	}*/

	$contatos = Contato::has('telefones')->get();

	foreach ($contatos as $key => $contato) {
		$contato->telefones;
	}

	return $contatos;

	// Retrieve all posts with at least one comment containing words like foo%
	/*$contatos = Contato::whereHas('telefones', function ($query) {
	    $query->where('user_id', '=', '$id');
	})->get();*/

	 /*$telefones = Telefone::all();

	 foreach ($telefones as $key => $telefone) {
	 	$x = $telefone->contato;
	 	$x->telefones;
	 	//echo $x;
	 	echo($key);


	 	//$tels = $x->telefones();
	 	//return $tels->telefone;
	 	//dd($tels);
	 	//dd($tels);
	 	//echo($x);
	 	
	 	//foreach ($tels as $tel) {
	 		//dd($tels);	
	 	//}

	 }*/

});

Route::get('getcontatoswithouttelefone', function(){

	$contatos = Contato::doesntHave('telefones')->get();

	return $contatos;


	/*$contatos = Contato::whereDoesntHave('telefones', function ($query) {
	    $query->where('user_id', '=', '$id');
	})->get();*/

});