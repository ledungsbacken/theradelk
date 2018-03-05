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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('index');
});

Route::resource('/post', 'Web\PostController', [
    'only' => [
        'index',
        'show',
    ]
]);


Route::get('/admin', function() {
    return view('vue');
});


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
