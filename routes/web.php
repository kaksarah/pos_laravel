<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\SalesController;


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

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/Categories/data', [CategoriesController::class, 'data'])->name('categories.data');
    Route::resource('/Categories', CategoriesController::class);

    Route::get('/Products/data', [ProductsController::class, 'data'])->name('products.data');
    Route::post('/Products/delete-selected', [ProductsController::class, 'deleteSelected'])->name('products.delete_selected');
    Route::post('/Products/print-barcode', [ProductsController::class, 'printBarcode'])->name('products.print_barcode');
    Route::resource('/Products', ProductsController::class);

    Route::get('/Transaction/new', [SalesController::class, 'create'])->name('transaction.new');
    Route::get('/Transaction/{id}/data', [SalesDetailController::class, 'data'])->name('transaction.data');
    Route::resource('/Transaction', SalesDetailController::class)
    ->except('show');
});

