<?php

use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentHistoryController;
use App\Http\Controllers\OnlyOfficeController;
use Illuminate\Support\Facades\Route;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');

// authentication
Route::get('/auth/login', [LoginBasic::class, 'index'])->name('login');
Route::post('/auth/login', [LoginBasic::class, 'login'])->name('login-store');
Route::get('/auth/register', [RegisterBasic::class, 'index'])->name('register');
Route::get('/auth/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

Route::group(['middleware' => 'auth:web'], function () {
  Route::post('/auth/logout', [LoginBasic::class, 'logout'])->name('logout');

  Route::group(['prefix' => 'document', 'as' => 'document.'], function () {
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::get('/{id}', [DocumentController::class, 'showDocument'])->name('show');
    Route::delete('/{id}', [DocumentController::class, 'deleteDocument'])->name('delete');
    Route::post('/create', [OnlyOfficeController::class, 'createDocument'])->name('create');
  });

  Route::group(['prefix' => 'document-history', 'as' => 'document-history.'], function () {
    Route::get('/', [DocumentHistoryController::class, 'index'])->name('index');
  });

});
Route::post('document-save', [OnlyOfficeController::class, 'saveDocument'])->name('document.save');



