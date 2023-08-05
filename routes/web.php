<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['middleware' => 'auth'])->prefix('portal')->name('portal.')->group(function () {

    Route::get('/', [HomeController::class, 'index']);

    // dashboard
	Route::get('dashboard', [\App\Http\Controllers\Portal\DashboardController::class, 'index'])->name('dashboard.index');

	Route::post('user-personal-details', [\App\Http\Controllers\Portal\UserProfileController::class, 'postPersonalDetails'])->name('user-personal-details.update');
	Route::get('user-verification', [\App\Http\Controllers\Portal\UserProfileController::class, 'getVerification'])->name('user-verification.edit');
	Route::post('user-verification', [\App\Http\Controllers\Portal\UserProfileController::class, 'postVerification'])->name('user-verification.update');
    Route::get('user-change-password', [\App\Http\Controllers\Portal\UserProfileController::class, 'getChangePassword'])->name('user-change-password.edit');
	Route::post('user-change-password', [\App\Http\Controllers\Portal\UserProfileController::class, 'postChangePassword'])->name('user-change-password.update');

    // user & profile
	Route::resource('user', \App\Http\Controllers\Portal\UserController::class);
	Route::resource('transaction', \App\Http\Controllers\Portal\TransactionController::class);
    Route::get('profile', [\App\Http\Controllers\Portal\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile-reward', [\App\Http\Controllers\Portal\ProfileController::class, 'postRewards'])->name('profile-reward.store');

    // others
    Route::resource('faq', \App\Http\Controllers\Portal\FaqController::class);
    Route::resource('contact', \App\Http\Controllers\Portal\ContactController::class);

    // auth
    Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');
    Route::get('/login', function () {
		return redirect()->route('portal.dashboard.index');
	});
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/', function () {
    return auth()->check()
            ? redirect()->route('portal.dashboard.index')
            : redirect()->route('login');
});

Route::get('/login', function () {
    return auth()->check()
        ? redirect()->route('portal.dashboard.index')
        : view('session/login-session');
})->name('login');
