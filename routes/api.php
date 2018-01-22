<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| get() = index() || show()
| post() = create()
| put() = update()
| delete() = destroy()
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('/post', 'PostController', [
    'only' => [
        'index',
        'show',
    ]
]);
Route::get('/post/slug/{slug}', 'PostController@showBySlug');


// Only logged in users here
Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('/user', 'UserController', [
        'only' => [
            'index',
        ]
    ]);
    Route::get('/user/log', 'UserController@loggedInLog');


    Route::resource('/post', 'PostController', [
        'only' => [
            'store',
            'update',
            'destroy',
        ]
    ]);
    Route::put('/post/{id}/restore', 'PostController@restoreDestroyed');
    Route::put('/post/{id}/file', 'PostController@storeFile');
    Route::put('/post/{id}/visibility', 'PostController@visibiltyStatus');
    Route::delete('/post/{id}/hard', 'PostController@hardDelete');

    Route::post('/image/upload', 'ImageController@upload');
});
