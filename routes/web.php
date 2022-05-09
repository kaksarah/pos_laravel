<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;

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

    Route::get('/Sales/data', [SalesController::class, 'data'])->name('sales.data');
    Route::get('/Sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/Sales/{show}', [SalesController::class, 'show'])->name('sales.show');
    Route::delete('/Sales/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');
    
    Route::get('/Transaction/new', [SalesController::class, 'create'])->name('transaction.new');
    Route::post('/Transaction/simpan', [SalesController::class, 'store'])->name('transaction.simpan');
    Route::get('/Transaction/nota-small', [SalesController::class, 'notaSmall'])->name('transaction.nota_small');
    Route::get('/Transaction/nota-big', [SalesController::class, 'notaBig'])->name('transaction.nota_big');
    Route::get('/Transaction/end', [SalesController::class, 'end'])->name('transaction.end');

    Route::get('/Transaction/{id}/data', [SalesDetailController::class, 'data'])->name('transaction.data');
    Route::get('/Transaction/loadform/{total}/{diterima}', [SalesDetailController::class, 'loadForm'])->name('transaction.load_form');
    Route::resource('/Transaction', SalesDetailController::class)
    ->except('show');

    Route::get('/Report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/Report/data/{start}/{end}', [ReportController::class, 'data'])->name('report.data');
    Route::get('/Report/pdf/{start}/{end}', [ReportController::class, 'exportPDF'])->name('report.exportPDF');

    Route::get('/User/data', [UsersController::class, 'data'])->name('user.data');
    Route::resource('/User', UsersController::class);

});

