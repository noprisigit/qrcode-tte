<?php

use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DinasController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VerifikasiPegawaiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\PIC\DocumentController as AppDocumentController;
use App\Http\Controllers\PIC\GenerateQrCodeController as AppGenerateQrCodeController;
use App\Http\Controllers\PIC\ProfileController as AppProfileController;
use App\Http\Controllers\PIC\VerificationController as AppVerificationController;
use App\Http\Controllers\PIC\VerifikasiPegawaiController as AppVerifikasiPegawaiController;
use App\Http\Controllers\User\DocumentController;
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


Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'login'])->name('login');
  Route::post('/login', [LoginController::class, 'doLogin'])->name('login.doLogin');
  Route::get('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/register', [RegisterController::class, 'doRegister'])->name('register.doRegister');
});


// Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
//   Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
//   Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login.process');
//   // Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
//   // Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.process');
// });

Route::middleware('auth')->group(function () {
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

  Route::get('/', function () {
    return view('main');
  });
  
  Route::group(['prefix' => 'administrator'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');


    Route::group(['prefix' => 'pegawai/verification'], function() {
      Route::get('/', [VerifikasiPegawaiController::class, 'index'])->name('admin.verifikasi-pegawai.index');
      Route::get('/{id}/verify', [VerifikasiPegawaiController::class, 'verify'])->name('admin.verifikasi-pegawai.verify');
      Route::get('/{id}/verify/accept', [VerifikasiPegawaiController::class, 'accept'])->name('admin.verifikasi-pegawai.accept');
      Route::get('/{id}/verify/reject', [VerifikasiPegawaiController::class, 'reject'])->name('admin.verifikasi-pegawai.reject');
      Route::get('/{id}/reset', [VerifikasiPegawaiController::class, 'reset'])->name('admin.verifikasi-pegawai.reset');
      Route::get('/{id}/detail', [VerifikasiPegawaiController::class, 'detail'])->name('admin.verifikasi-pegawai.detail');
      Route::get('/{id}/generate', [VerifikasiPegawaiController::class, 'generateTte'])->name('admin.verifikasi-pegawai.tte');
      Route::post('/send/mail', [VerifikasiPegawaiController::class, 'sendToMail'])->name('admin.verifikasi-pegawai.sendToMail');
    });

    Route::group(['prefix' => 'pegawai'], function() {
      Route::get('/', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
      Route::get('/{id}/verification', [PegawaiController::class, 'verification'])->name('admin.pegawai.verification');
      Route::get('/{id}/detail', [PegawaiController::class, 'detail'])->name('admin.pegawai.detail');
      Route::post('/verification/accept', [PegawaiController::class, 'accept'])->name('admin.pegawai.verification.accept');
      Route::post('/verification/reject', [PegawaiController::class, 'reject'])->name('admin.pegawai.verification.reject');
      Route::get('/{id}/generate', [PegawaiController::class, 'generateTte'])->name('admin.pegawai.tte');
      Route::post('/{id}/upload/logo', [PegawaiController::class, 'uploadLogo'])->name('admin.pegawai.upload-logo');
      Route::post('/generate/qrcode', [PegawaiController::class, 'generateQrCode'])->name('admin.pegawai.generate-qrcode');
    });

    Route::group(['prefix' => 'users'], function() {
      Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
      Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
      Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
      Route::get('/{id}/show', [UserController::class, 'show'])->name('admin.user.show');
      Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
      Route::post('/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
      Route::get('/{id}/destroy', [UserController::class, 'destroy'])->name('admin.user.destroy');
    });
  
    Route::resource('dinas', DinasController::class, ['as' => 'admin', 'parameters' => ['dinas' => 'id']]);
  
    Route::resource('bidang', BidangController::class, ['as' => 'admin', 'parameters' => ['bidang' => 'id']]);
  });
  
  Route::group(['prefix' => 'pic'], function() {
    Route::get('/', function() {
      return view('pic.dashboard.dashboard-index');
    })->name('pic.dashboard.index');

    Route::group(['prefix' => 'pegawai/verification'], function() {
      Route::get('/', [AppVerifikasiPegawaiController::class, 'index'])->name('pic.verifikasi-pegawai.index');
      Route::get('/{id}/verify', [AppVerifikasiPegawaiController::class, 'verify'])->name('pic.verifikasi-pegawai.verify');
      Route::get('/{id}/verify/accept', [AppVerifikasiPegawaiController::class, 'accept'])->name('pic.verifikasi-pegawai.accept');
      Route::get('/{id}/verify/reject', [AppVerifikasiPegawaiController::class, 'reject'])->name('pic.verifikasi-pegawai.reject');
      Route::get('/{id}/reset', [AppVerifikasiPegawaiController::class, 'reset'])->name('pic.verifikasi-pegawai.reset');
      Route::get('/{id}/detail', [AppVerifikasiPegawaiController::class, 'detail'])->name('pic.verifikasi-pegawai.detail');
      Route::get('/{id}/generate', [AppVerifikasiPegawaiController::class, 'generateTte'])->name('pic.verifikasi-pegawai.tte');
    });

    Route::group(['prefix' => 'verification'], function() {
      Route::get('/', [AppVerificationController::class, 'index'])->name('pic.verification.index');
      Route::get('/{id}/edit', [AppVerificationController::class, 'edit'])->name('pic.verification.edit');
      Route::get('/{id}/detail', [AppVerificationController::class, 'detail'])->name('pic.verification.detail');
      Route::post('/accept', [AppVerificationController::class, 'accept'])->name('pic.verification.accept');
      Route::post('/reject', [AppVerificationController::class, 'reject'])->name('pic.verification.reject');
      Route::get('/profile', [AppVerificationController::class, 'profile'])->name('pic.verification.profile');
      Route::post('/reset', [AppVerificationController::class, 'reset'])->name('pic.verification.reset');
    });

    Route::group(['prefix' => 'profile'], function() {
      Route::get('/', [AppProfileController::class, 'index'])->name('pic.profile.index');
      Route::get('/edit', [AppProfileController::class, 'edit'])->name('pic.profile.edit');
      Route::put('/update', [AppProfileController::class, 'update'])->name('pic.profile.update');
      Route::get('/change-password', [AppProfileController::class, 'changePassword'])->name('pic.profile.change-password');
      Route::post('/change-password', [AppProfileController::class, 'changePasswordProcess'])->name('pic.profile.change-password.process');
    });
    
    Route::group(['prefix' => 'documents'], function () {
      Route::get('/', [AppDocumentController::class, 'index'])->name('pic.documents.index');
      Route::post('/store', [AppDocumentController::class, 'store'])->name('pic.documents.store');
      Route::get('/{id}/destroy', [AppDocumentController::class, 'destroy'])->name('pic.documents.destroy');
    });

    Route::group(['prefix' => 'generate'], function() {
      Route::get('/', [AppGenerateQrCodeController::class, 'index'])->name('pic.generate-qrcode.index');
      Route::post('/generate', [AppGenerateQrCodeController::class, 'generate'])->name('pic.generate-qrcode.generate');
      Route::post('/upload/logo', [AppGenerateQrCodeController::class, 'uploadLogo'])->name('pic.generate-qrcode.upload-logo');
      Route::post('/send/mail', [AppGenerateQrCodeController::class, 'sendToMail'])->name('pic.generate-qrcode.sendToMail');
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

    Route::group(['prefix' => 'documents'], function() {
      Route::get('/', [DocumentController::class, 'index'])->name('user.documents.index');
      Route::post('/store', [DocumentController::class, 'store'])->name('user.documents.store');
      Route::get('/{id}/destroy', [DocumentController::class, 'destroy'])->name('user.documents.destroy');
    });

    Route::group(['prefix' => 'verification'], function() {
      Route::get('/', [VerificationController::class, 'index'])->name('user.verification.index');
      Route::post('/reset', [VerificationController::class, 'reset'])->name('user.verification.reset');
    });

    Route::group(['prefix' => 'generate'], function() {
      Route::get('/', [GenerateQrCodeController::class, 'index'])->name('user.generate-qrcode.index');
      Route::post('/generate', [GenerateQrCodeController::class, 'generate'])->name('user.generate-qrcode.generate');
      Route::post('/upload/logo', [GenerateQrCodeController::class, 'uploadLogo'])->name('user.generate-qrcode.upload-logo');
      Route::get('/result', [GenerateQrCodeController::class, 'result'])->name('user.generate-qrcode.result');
      Route::post('/send/mail', [GenerateQrCodeController::class, 'sendToMail'])->name('user.generate-qrcode.sendToMail');
    });
  });
});

Route::get('/bidang', [HelperController::class, 'selectBidang'])->name('bidang.select');
Route::get('/{unique_code}', [HelperController::class, 'showDetailPegawai'])->name('link.detail.pegawai');
