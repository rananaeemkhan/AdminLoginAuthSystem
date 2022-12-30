<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\HomeController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\HomeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin

Route::namespace ('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace ('Auth')->middleware('guest:admin')->group(function () {
        // Admin login Route
        // Route::get('login', 'AuthenticatedSessionController@create')->name('login');
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        // Route::get('login', [AuthenticatedSessionController::class, 'create']);

        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('adminlogin');
    });
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::get('dashboard', [HomeController::class, 'index']);
});
