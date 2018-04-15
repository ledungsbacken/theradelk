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


Route::resource('/post', 'Api\PostController', [
    'only' => [
        'index',
        'show',
    ]
]);
Route::get('/post/slug/{slug}', 'Api\PostController@showBySlug');
Route::post('/post/{id}/add/view', 'Api\PostController@addView');

Route::resource('/category', 'Api\CategoryController', [
    'only' => [
        'index',
        'show',
    ]
]);

Route::resource('/subcategory', 'Api\SubcategoryController', [
    'only' => [
        'index',
    ]
]);

Route::resource('/user', 'Api\UserController', [
    'only' => [
        'index',
        'show',
    ]
]);


// Only logged in users here
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user/status', 'Api\UserController@isLoggedIn');
    Route::resource('/user', 'Api\UserController', [
        'only' => [
            'store',
            'update',
        ]
    ]);
    Route::get('/user/log', 'Api\UserController@loggedInLog');
    Route::get('/user/current', 'Api\UserController@getCurrent');
    Route::put('/user/{id}/role', 'Api\UserController@syncRoles');
    Route::put('/user/{id}/password/reset', 'Api\UserController@resetPassword');


    Route::get('/role', 'Api\UserController@indexRoles');


    Route::resource('/post', 'Api\PostController', [
        'only' => [
            'store',
            'update',
            'destroy',
        ]
    ]);
    Route::get('/posts/admin', 'Api\PostController@indexAdmin');
    Route::get('/posts/category', 'Api\PostController@indexByCategory');
    Route::put('/post/{id}/restore', 'Api\PostController@restoreDestroyed');
    Route::put('/post/{id}/file', 'Api\PostController@storeFile');
    Route::put('/post/{id}/publish', 'Api\PostController@setPublished');
    Route::put('/post/{id}/hidden', 'Api\PostController@setHidden');
    Route::delete('/post/{id}/delete/hard', 'Api\PostController@hardDelete');

    Route::resource('/category', 'Api\CategoryController', [
        'only' => [
            'store',
            'update',
        ]
    ]);
    Route::get('/category/{id}/subcategory', 'Api\SubcategoryController@indexByCategory');

    Route::resource('/subcategory', 'Api\SubcategoryController', [
        'only' => [
            'store',
            'update',
        ]
    ]);

    Route::resource('/scenery', 'Api\SceneryController', [
        'only' => [
            'index',
            'show',
            'store',
            'update',
        ]
    ]);

    Route::post('/image/upload', 'Api\ImageController@upload');
    Route::resource('/image', 'Api\ImageController', [
        'only' => [
            'index',
            'destroy',
        ]
    ]);

    Route::post('/headimage/upload', 'Api\HeadImageController@upload');
    Route::resource('/headimage', 'Api\HeadImageController', [
        'only' => [
            'index',
        ]
    ]);
});
