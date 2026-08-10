<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale (fr)
Route::get('/', function () {
    return redirect('/fr');
});

Route::prefix('{locale}')->where(['locale' => 'fr|ar|en'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/products/brand/{brand}', [App\Http\Controllers\ProductController::class, 'brandShow'])->name('products.brand');
    Route::get('/products/brand/{brand}/collection/{collection}', [App\Http\Controllers\ProductController::class, 'collectionShow'])->name('products.collection');
    Route::get('/products/brand/{brand}/collection/{collection}/product/{product}', [App\Http\Controllers\ProductController::class, 'productShow'])->name('products.show');
    Route::get('/projects', [PageController::class, 'projects'])->name('projects');
    Route::get('/projects/{id}', [PageController::class, 'projectShow'])->name('projects.show');
    Route::get('/professionals', [PageController::class, 'professionals'])->name('professionals');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/legal', [PageController::class, 'legal'])->name('legal');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/thank-you/{order}', [\App\Http\Controllers\CheckoutController::class, 'thankYou'])->name('checkout.thank-you');
});

Route::get('/run-migrations', function () {
    try {
        echo "Running migrations...<br>";
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        echo "Migrations done!<br>";

        echo "Cleaning cache...<br>";
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        echo "Cache cleared!<br>";

        return "Success! You can now delete this route from web.php and refresh your site.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/run-seeder', function () {
    try {
        echo "Running seeders...<br>";
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        echo "Seeders done!<br>";
        return "Success! Admin user created. You can now log in.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/fix-storage', function () {
    try {
        echo "Creating storage link...<br>";
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        
        echo "Checking for private images...<br>";
        $privatePath = storage_path('app/private/collections');
        $publicPath = storage_path('app/public/collections');
        
        if (file_exists($privatePath)) {
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            
            $files = scandir($privatePath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    if (copy($privatePath . '/' . $file, $publicPath . '/' . $file)) {
                        echo "Copied: $file to public storage<br>";
                    }
                }
            }
        }

        echo "Cleaning cache...<br>";
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');

        echo "Link and files fixed!<br>";
        return "Success! Your images should now be visible on the front-end.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/seed-caesar', function () {
    try {
        echo "Starting Caesar Products Import (this may take a minute)...<br>";
        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'CaesarProductsSeeder',
            '--force' => true
        ]);
        echo "Import complete!<br>";
        return "Success! Caesar products have been added to the database.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

