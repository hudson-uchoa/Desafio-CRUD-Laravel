<?php

use App\Http\Controllers\PessoaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsuarioController::class, 'index'])->name('login');
Route::get('/signup', [UsuarioController::class, 'createForm'])->name('signup');
Route::post('/userSignup', [UsuarioController::class, 'create'])->name('create.user');
Route::get('/userinfo/{user_id}', [PessoaController::class, 'info'])->name('signup2')->middleware(['auth']);
Route::get('/dashboard/{user_id}', [PessoaController::class, 'dashboard'])->name('dashboard')->middleware(['auth']);
Route::get('/update/{user_id}', [PessoaController::class, 'updateForm'])->middleware(['auth']);
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout.user');
Route::post('/data', [PessoaController::class, 'create'])->name('create.data')->middleware(['auth']);
Route::post('/auth', [UsuarioController::class, 'auth'])->name('auth.user');
Route::delete('/delete/{user_id}', [PessoaController::class, 'delete'])->name('delete.user')->middleware(['auth']);
Route::put('/updateinfo/{user_id}', [PessoaController::class, 'update'])->name("update.user")->middleware(['auth']);
