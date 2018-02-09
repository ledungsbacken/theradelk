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
Route::post('/post/{id}/add/view', 'PostController@addView');


// Only logged in users here
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user/status', 'UserController@isLoggedIn');
    Route::resource('/user', 'UserController', [
        'only' => [
            'index',
            'show',
            'store',
            'update',
        ]
    ]);
    Route::get('/user/log', 'UserController@loggedInLog');
    Route::get('/user/current', 'UserController@getCurrent');
    Route::put('/user/{id}/role', 'UserController@syncRoles');
    Route::put('/user/{id}/password/reset', 'UserController@resetPassword');


    Route::get('/role', 'UserController@indexRoles');


    Route::resource('/post', 'PostController', [
        'only' => [
            'store',
            'update',
            'destroy',
        ]
    ]);
    Route::get('/posts/admin', 'PostController@indexAdmin');
    Route::put('/post/{id}/restore', 'PostController@restoreDestroyed');
    Route::put('/post/{id}/file', 'PostController@storeFile');
    Route::put('/post/{id}/publish', 'PostController@setPublished');
    Route::put('/post/{id}/hidden', 'PostController@setHidden');
    Route::delete('/post/{id}/delete/hard', 'PostController@hardDelete');

    Route::resource('/category', 'categoryController', [
        'only' => [
            'index',
            'show',
            'store',
            'update',
        ]
    ]);
    Route::get('/category/{id}/subcategory', 'SubcategoryController@indexByCategory');

    Route::resource('/subcategory', 'SubcategoryController', [
        'only' => [
            'index',
            'store',
            'update',
        ]
    ]);

    Route::post('/image/upload', 'ImageController@upload');
    Route::resource('/image', 'ImageController', [
        'only' => [
            'index',
        ]
    ]);

    Route::post('/headimage/upload', 'HeadImageController@upload');
    Route::resource('/headimage', 'HeadImageController', [
        'only' => [
            'index',
        ]
    ]);
});
