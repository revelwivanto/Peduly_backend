<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\PropertyController;
use App\Http\Controllers\Agent\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PropertyController as FrontendPropertyController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\User\RatingController as UserRatingController;
use App\Http\Controllers\User\CommentController as UserCommentController;
use App\Http\Controllers\PaymentController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/message', [App\Http\Controllers\PagesController::class, 'messageContact'])->name('contact.message');

Route::get('/activities', [FrontendPropertyController::class, 'index'])->name('activities');
Route::get('/properties', [FrontendPropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [FrontendPropertyController::class, 'show'])->name('properties.show');
Route::post('/properties/{property:slug}/comments', [FrontendPropertyController::class, 'propertyComments'])->name('properties.comments');
Route::post('/properties/rating', [FrontendPropertyController::class, 'propertyRating'])->name('properties.rating');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Authentication Routes
Auth::routes();

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('ratings', RatingController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Agent Routes
Route::middleware(['auth', 'agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', PropertyController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// User Routes
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');
    Route::resource('messages', MessageController::class);
    Route::resource('favorites', FavoriteController::class);
    Route::resource('ratings', UserRatingController::class);
    Route::resource('comments', UserCommentController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/payment/{property:slug}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{property:slug}', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/{property:slug}/tshirt', [PaymentController::class, 'tshirtSelection'])->name('payment.tshirt');
Route::post('/payment/{property:slug}/tshirt', [PaymentController::class, 'processTshirt'])->name('payment.tshirt.process');
