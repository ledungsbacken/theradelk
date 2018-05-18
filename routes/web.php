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

// Route::get('/', function() {
//     return view('index');
// });

Route::get('/', 'Web\PostController@index');
Route::get('/post/{slug}', 'Web\PostController@show');

Route::get('/post', function() {
    return Redirect('/');
});

Route::get('/search', 'Web\PostController@search');


Route::get('/latest', 'Web\PostController@indexLatest');

Route::get('/category/{category}', 'Web\PostController@indexByCategory');
Route::get('/category/{category}/{subcategory}', 'Web\PostController@indexBySubcategory');

Route::get('/user/{userId}', 'Web\UserController@show');

Route::get('/about', 'ViewController@about');
Route::get('/join', 'ViewController@join');

Route::get('/join-us', 'ViewController@join');
Route::get('/contact', 'ViewController@contact');

Route::get('/theme/set/{theme}', function($theme) {
    if($theme == 'light') {
        session(['theme' => 'light']);
    } else if($theme == 'dark') {
        session(['theme' => 'dark']);
    }
    Session::save();
    return redirect()->back();
});


Route::get('/admin', function() {
    return view('vue');
})->middleware('auth');


Auth::routes();

Route::get('/register', function() {
    return redirect('/');
})->name('register');

Route::post('/register', function() {
    return redirect('/');
})->name('register');

Route::get('/logout', function() {
    if(Auth::check()) {
        Auth::logout();
    }
    return redirect('/');
})->name('logout');


Route::get('images/{filename}', function ($filename)
{
    $path = storage_path('app/public/images/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});