<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\User\Home as UserHome;
use Illuminate\Http\Request;

Route::get('/', UserHome::class)->name('home');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');



// Hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Admin dashboard
    Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
});
