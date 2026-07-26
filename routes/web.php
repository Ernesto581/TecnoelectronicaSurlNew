<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home', [
        'featuredProducts' => Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(4)
            ->get(),
    ]);
});

Route::get('/dashboard', fn () => redirect()->route('profile.edit'))
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::post('/tienda/producto/{product}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('store.product.review');

Route::get('/tienda', [StoreController::class, 'index'])->name('store.index');
Route::get('/tienda/producto/{product}', [StoreController::class, 'show'])->name('store.product.show');
Route::get('/tienda/{category:slug}', [StoreController::class, 'category'])->name('store.category.show');

Route::view('/servicio-domicilio', 'pages.servicio-domicilio');
Route::view('/quienes-somos', 'pages.quienes-somos');
Route::view('/terminos-y-condiciones', 'pages.terminos');
Route::view('/servicios', 'pages.servicios');
Route::view('/contacto', 'pages.contacto');
Route::view('/condiciones-de-venta', 'pages.condiciones-venta');
Route::view('/plazos-de-entrega', 'pages.plazos-entrega');
Route::view('/politica-de-devoluciones', 'pages.politica-devoluciones');

Route::get('/robots.txt', function () {
    $url = config('app.url');
    return response("User-agent: *\nAllow: /\nDisallow: /admin\n\nSitemap: {$url}/sitemap.xml\n")
        ->header('Content-Type', 'text/plain');
});

Route::get('/sitemap.xml', function () {
    $base = config('app.url');
    $pages = [
        ['loc' => '/', 'priority' => '1.0'],
        ['loc' => '/tienda', 'priority' => '0.9'],
        ['loc' => '/servicio-domicilio', 'priority' => '0.8'],
        ['loc' => '/quienes-somos', 'priority' => '0.7'],
        ['loc' => '/contacto', 'priority' => '0.7'],
        ['loc' => '/login', 'priority' => '0.5'],
        ['loc' => '/terminos-y-condiciones', 'priority' => '0.4'],
        ['loc' => '/condiciones-de-venta', 'priority' => '0.4'],
        ['loc' => '/plazos-de-entrega', 'priority' => '0.4'],
        ['loc' => '/politica-de-devoluciones', 'priority' => '0.4'],
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($pages as $page) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$base}{$page['loc']}</loc>\n";
        $xml .= "    <priority>{$page['priority']}</priority>\n";
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';

    return response($xml)->header('Content-Type', 'application/xml');
});

Route::middleware(['auth', 'admin'])->prefix('product-dashboard')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/crear', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product}/editar', [ProductController::class, 'edit'])->name('edit');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    Route::post('/{product}/restaurar', [ProductController::class, 'restore'])->withTrashed()->name('restore');
});

Route::middleware(['auth', 'admin'])->prefix('profile-dashboard')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
});

Route::middleware(['auth', 'admin'])->prefix('order-dashboard')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::patch('/{order}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
});

Route::middleware('auth')->prefix('pedidos')->name('pedidos.')->group(function () {
    Route::get('/', [OrderController::class, 'customerOrders'])->name('index');
    Route::get('/{order}', [OrderController::class, 'customerShow'])->name('show');
    Route::post('/{order}/cancelar', [OrderController::class, 'customerCancel'])->name('cancel');
});

Route::middleware(['auth', 'admin'])->prefix('category-dashboard')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/crear', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
    Route::get('/{category}/editar', [CategoryController::class, 'edit'])->name('edit');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    Route::post('/{category}/restaurar', [CategoryController::class, 'restore'])->withTrashed()->name('restore');
});

require __DIR__.'/auth.php';
