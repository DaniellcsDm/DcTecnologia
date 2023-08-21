<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendaController;

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
    return view('welcome');
});

// Rotas de autenticação
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rotas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rotas de redefinição de senha
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Rotas de verificação de e-mail (se for o caso)
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Rotas De Vendas
Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas.create');
Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
Route::get('/vendas/{venda}', [VendaController::class, 'show'])->name('vendas.show');
Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
Route::get('vendas/{venda}/editar', [VendaController::class, 'edit'])->name('vendas.edit');
Route::delete('/vendas/{venda}', [VendaController::class, 'destroy'])->name('vendas.destroy');
Route::get('/vendas/{venda}/parcelas', [VendaController::class, 'showParcelas'])->name('vendas.parcelas');
Route::get('vendas/{venda}/pdf', [VendaController::class, 'generatePDF'])->name('vendas.pdf');
Route::get('/vendas/{venda}/parcelas/pdf', [VendaController::class, 'downloadPdf'])->name('vendas.parcelas.pdf');
