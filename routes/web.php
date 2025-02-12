<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('pages.app.dashboard-home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.app.dashboard-sig', ['type_menu' => '']);
    })->name('home');
    Route::resource('user', UserController::class);
});

Route::get('/tambah-data', function () {
    return view('pages.app.tambah-data', ['type_menu' => '']);
})->name('tambah.data');

Route::get('/list-data', function () {
    return view('pages.app.list-data', ['type_menu' => '']);
})->name('list.data');

Route::get('/dashboard-admin', function () {
    return view('pages.app.dashboard-sig');
})->name('dashboard.admin');

// Route::get('/dashboard-home', function () {
//     return view('pages.depan.dashboard-home', ['type_menu' => '']);
// })->name('dashboard.home');



// Route::get('/register', function () {
//     return view('pages.auth.auth-register');
// })->name('register');

// Route::get('/forgot', function () {
//     return view('pages.auth.auth-forgot-password');
// })->name('forgot');

// Route::get('/reset-password', function () {
//     return view('pages.auth.auth-reset-password');
// })->name('reset-password');
