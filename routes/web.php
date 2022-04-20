<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController,
    BrandController, CategoryController, ProductController};


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' =>false
]);


// Route::get('brand', [BrandController::class,'index'])->name('brand.index');
Route::group(['prefix' => 'dashboard', 'middleware' => ['web','auth']],function () {
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);

    Route::get('product/trash',[ProductController::class,'trash'])->name('product.trash');
    Route::get('product/restore/{id}', [ProductController::class,'restore'])->name('product.restore');
    Route::delete('product/forcedelete/{id}', [ProductController::class,'forceDelete'])->name('product.kill');
    Route::resource('product', ProductController::class);
});

// Route::get('category', [CategoryController::class,'index'])->name('category.index');
// Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
// Route::get('category/{id}', [CategoryController::class,'edit'])->name('category.edit');
// Route::post('category', [CategoryController::class,'store'])->name('category.store');
// Route::delete('category/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
// Route::put('category/{id}', [CategoryController::class,'update'])->name('category.update');



