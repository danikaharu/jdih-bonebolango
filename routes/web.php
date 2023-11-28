<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VisitorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Route Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category
    Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class)->except('show');

    // Product
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);

    // Reply Discussion
    Route::get('/discussion/reply/{id}', [App\Http\Controllers\Admin\ReplyController::class, 'replyDiscussion'])->name('discussion.reply');
    Route::post('/discussion/reply/{id}', [App\Http\Controllers\Admin\ReplyController::class, 'storeReplyDiscussion'])->name('discussion.storeReply');

    // Comment
    Route::post('/discussion/comment', [App\Http\Controllers\Admin\CommentController::class, 'store'])->name('comment.store');
    Route::post('/discussion/{discussion}/reply', [App\Http\Controllers\Admin\CommentController::class, 'storeReplyComment'])->name('comment.storeReplyComment');

    // Discussion
    Route::resource('/discussion', App\Http\Controllers\Admin\DiscussionController::class);

    // Request Product
    Route::resource('/request-product', App\Http\Controllers\RequestProductController::class)->except('edit', 'update');

    // Survey
    Route::resource('/survey', App\Http\Controllers\Admin\SurveyController::class)->except('edit', 'update');

    // Gallery
    Route::resource('/gallery', App\Http\Controllers\Admin\GalleryController::class);
    Route::put('/gallery/update-image/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'updateImage'])->name('update-image');
    Route::delete('/gallery/remove-image/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'removeImage'])->name('remove-image');

    // News
    Route::resource('/news', App\Http\Controllers\Admin\NewsController::class);

    // Profile
    Route::resource('/profile', App\Http\Controllers\Admin\ProfileController::class)->except('index', 'create', 'store', 'destroy');

    // Visitor
    Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);


Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

Route::get('/berita', [App\Http\Controllers\User\HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{news}', [App\Http\Controllers\User\HomeController::class, 'detail_berita'])->name('detail-berita');

Route::get('/profil', [App\Http\Controllers\User\HomeController::class, 'profil'])->name('profil');

Route::get('/galeri', [App\Http\Controllers\User\HomeController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{gallery}', [App\Http\Controllers\User\HomeController::class, 'detail_galeri'])->name('detail-galeri');

Route::get('/forum', [App\Http\Controllers\User\HomeController::class, 'forum'])->name('forum');
Route::get('/forum/{discussion}', [App\Http\Controllers\User\HomeController::class, 'detail_forum'])->name('detail-forum');
Route::post('/forum', [App\Http\Controllers\User\DiscussionController::class, 'store'])->middleware('throttle:public')->name('forum.store');
Route::post('/forum/{discussion}/reply', [App\Http\Controllers\User\DiscussionController::class, 'storeReplyComment'])->name('forum.storeReplyComment');

Route::get('/produk', [App\Http\Controllers\User\HomeController::class, 'produk'])->name('produk');
Route::get('/produk/{product}', [App\Http\Controllers\User\HomeController::class, 'detail_produk'])->name('detail-produk');
Route::post('/produk', [App\Http\Controllers\User\RequestProductController::class, 'store'])->name('request-product.store');
Route::get('/download/{product}', [App\Http\Controllers\User\HomeController::class, 'unduh_produk'])->name('unduh-produk');

Route::post('/survey', [App\Http\Controllers\User\SurveyController::class, 'store'])->middleware('throttle:public')->name('survey.store');
