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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

use App\Domains\Contact\Http\Controllers\Api\Contact\ContactController;

Route::group([
    'prefix' => 'contact',
    'as' => 'contact.',
], function () {

    Route::get('/', [ContactController::class, 'index'])
    Route::post('/', [ContactController::class, 'store'])->name('index');
    Route::group(['prefix' => '{project}'], function () {
        Route::get('/', [ContactController::class, 'show'])->name('show');
        Route::put('/', [ContactController::class, 'update'])->name('update');
        Route::delete('/', [ContactController::class, 'delete'])->name('destroy');
    });
});
