<?php

use App\Livewire\Auth\Login;
use Illuminate\Http\Request;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Posts\Category;
use App\Livewire\User\Home as UserHome;
use App\Livewire\Admin\Posts\PostComponent;
use App\Livewire\Admin\Dashboard as AdminDashboard;




Route::get('/', UserHome::class)->name('home');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');



// Hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Admin dashboard
    Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('categories',Category::class)->name('admin.categories');
    Route::get('posts', PostComponent::class)->name('admin.posts');
});
