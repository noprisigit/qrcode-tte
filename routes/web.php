<?php

use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\DinasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\PIC\VerificationController as AppVerificationController;
use App\Http\Controllers\User\GenerateQrCodeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\VerificationController;
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




Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
  Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
  Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login.process');
  Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
  Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.process');
});

Route::middleware('auth')->group(function () {
  Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

  Route::get('/', function () {
    return view('main');
  });
  
  Route::group(['prefix' => 'administrator'], function () {
  
    Route::resource('dinas', DinasController::class, ['as' => 'admin', 'parameters' => ['dinas' => 'id']]);
  
    Route::resource('bidang', BidangController::class, ['as' => 'admin', 'parameters' => ['bidang' => 'id']]);
  });
  
  Route::group(['prefix' => 'pic'], function() {
    Route::get('/', function() {
      return view('pic.dashboard.dashboard-index');
    })->name('pic.dashboard.index');

    Route::group(['prefix' => 'verification'], function() {
      Route::get('/', [AppVerificationController::class, 'index'])->name('pic.verification.index');
      Route::get('/{id}/edit', [AppVerificationController::class, 'edit'])->name('pic.verification.edit');
      Route::get('/{id}/detail', [AppVerificationController::class, 'detail'])->name('pic.verification.detail');
      Route::post('/accept', [AppVerificationController::class, 'accept'])->name('pic.verification.accept');
      Route::post('/reject', [AppVerificationController::class, 'reject'])->name('pic.verification.reject');
    });
  });
  
  Route::group(['prefix' => 'user'], function() {
    Route::get('/', function() {
      return view('user.dashboard.dashboard-index');
    })->name('user.dashboard.index');
  
    Route::group(['prefix' => 'profile'], function() {
      Route::get('/', [ProfileController::class, 'index'])->name('user.profile.index');
      Route::get('/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
      Route::put('/update', [ProfileController::class, 'update'])->name('user.profile.update');
      Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('user.profile.change-password');
      Route::post('/change-password', [ProfileController::class, 'changePasswordProcess'])->name('user.profile.change-password.process');
    });

    Route::group(['prefix' => 'verification'], function() {
      Route::get('/', [VerificationController::class, 'index'])->name('user.verification.index');
      Route::post('/reset', [VerificationController::class, 'reset'])->name('user.verification.reset');
    });

    Route::group(['prefix' => 'generate'], function() {
      Route::get('/', [GenerateQrCodeController::class, 'index'])->name('user.generate-qrcode.index');
      Route::post('/generate', [GenerateQrCodeController::class, 'generate'])->name('user.generate-qrcode.generate');
      Route::post('/upload/logo', [GenerateQrCodeController::class, 'uploadLogo'])->name('user.generate-qrcode.upload-logo');
    });
  });
});

Route::get('/bidang', [HelperController::class, 'selectBidang'])->name('bidang.select');
