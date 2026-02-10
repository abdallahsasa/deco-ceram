<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale (fr)
Route::get('/', function () {
    return redirect('/fr');
});

Route::prefix('{locale}')->where(['locale' => 'fr|ar|en'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/products', [PageController::class, 'products'])->name('products');
    Route::get('/products/{id}', [PageController::class, 'productShow'])->name('products.show');
    Route::get('/projects', [PageController::class, 'projects'])->name('projects');
    Route::get('/projects/{id}', [PageController::class, 'projectShow'])->name('projects.show');
    Route::get('/professionals', [PageController::class, 'professionals'])->name('professionals');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/legal', [PageController::class, 'legal'])->name('legal');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
});
