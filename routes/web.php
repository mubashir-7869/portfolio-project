<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FunFactController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\WhatWeDoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/search', [ProfileController::class, 'search'])->name('search');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::get('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('slider')->name('slider.')->group(function () {
        Route::resource('/', SliderController::class);
        Route::post('/store', [SliderController::class, 'store'])->name('store');
        Route::get('/search', [SliderController::class, 'search'])->name('search');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SliderController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SliderController::class, 'destroy'])->name('destroy');
    });
    // service
    Route::prefix('services')->name('services.')->group(function () {
        Route::resource('/', ServiceController::class);
        Route::get('/search', [ServiceController::class, 'search'])->name('search');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ServiceController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });

    // What We Do
    Route::prefix('whatwedo')->name('whatwedo.')->group(function () {
        Route::resource('/', WhatWeDoController::class);
        Route::get('/search', [WhatWeDoController::class, 'search'])->name('search');
        Route::post('/store', [WhatWeDoController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [WhatWeDoController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [WhatWeDoController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [WhatWeDoController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::resource('/', PortfolioController::class);
        Route::get('/search', [PortfolioController::class, 'search'])->name('search');

        Route::post('/update-category', [PortfolioController::class, 'updateCategory'])->name('update.category');
        Route::get('/edit/{id}', [PortfolioController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PortfolioController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [PortfolioController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::resource('/', CategoryController::class);
        Route::get('/search', [CategoryController::class, 'search'])->name('search');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    // Blog
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::resource('/', BlogController::class);
        Route::get('/search', [BlogController::class, 'search'])->name('search');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [BlogController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('funfacts')->name('funfacts.')->group(function () {
        Route::resource('/', FunFactController::class);
        Route::get('/search', [FunFactController::class, 'search'])->name('search');
        Route::get('/edit/{id}', [FunFactController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [FunFactController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [FunFactController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('social-links')->name('social-links.')->group(function () {
        Route::resource('/', SocialLinkController::class);
        Route::get('/search', [SocialLinkController::class, 'search'])->name('search');
        Route::post('/store', [SocialLinkController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SocialLinkController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SocialLinkController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SocialLinkController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::resource('/', ContactController::class);
        Route::get('/search', [ContactController::class, 'search'])->name('search');
        Route::get('review/{id}', [ContactController::class,'markAsReviewed'])->name('review');
        Route::get('destroy/{id}', [ContactController::class,'destroy'])->name('destroy');
    });

});
Route::get('contact/store', [ContactController::class, 'store'])->name('contact-us.store');

require __DIR__ . '/auth.php';
