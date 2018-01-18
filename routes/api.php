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


// Only logged in users here
Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('/user', 'UserController', [
        'only' => [
            'index',
        ]
    ]);
    Route::resource('/post', 'PostController', [
        'only' => [
            'store',
            'update',
        ]
    ]);
});
