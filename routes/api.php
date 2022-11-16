<?php

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/search', [\App\Http\Controllers\Admin\SearchController::class, 'search']);
Route::get('/searchProduct', [\App\Http\Controllers\User\Search\SearchProductController::class, 'search']);
Route::get('/searchNews', [\App\Http\Controllers\User\Search\SearchNewsController::class, 'search']);
Route::get('/searchDiscussion', [\App\Http\Controllers\User\Search\SearchDiscussionController::class, 'search']);
Route::get('/searchGallery', [\App\Http\Controllers\User\Search\SearchGalleryController::class, 'search']);
Route::get('/jdih', function () {
    return ProductResource::collection(Product::all());
});
