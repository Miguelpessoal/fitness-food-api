<?php

use App\Http\Controllers\{
    ApiReportController,
    ProductController,
    SearchController
};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/api-key', fn() => ['api_key' => Str::random(60)]);

Route::middleware('api.key')->group(function () {
    Route::get('/', ApiReportController::class);

    Route::resource('products', ProductController::class)->except([
        'create',
        'edit',
    ]);

    Route::get('search', SearchController::class);
});
