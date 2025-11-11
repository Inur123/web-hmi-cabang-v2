<?php

use App\Livewire\Auth\Login;
use Illuminate\Http\Request;
use App\Livewire\Auth\Register;

use App\Livewire\User\Blog\BlogMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Posts\Category;
use App\Livewire\User\Blog\BlogDetail;
use App\Livewire\User\Home as UserHome;
use App\Livewire\Admin\Posts\PostComponent;
use App\Livewire\User\Blog\Category\CategoryShow;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Activities\ActivityComponent;





Route::get('/', UserHome::class)->name('home');

Route::get('/blog', BlogMenu::class)->name('blog');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.show');
Route::get('/blog/{category:slug}', BlogMenu::class)->name('blog.category');
Route::get('/categories/{slug}', CategoryShow::class)->name('categories.show');


Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');



// Hanya untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Admin dashboard
    Route::get('dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('categories',Category::class)->name('admin.categories');
    Route::get('posts', PostComponent::class)->name('admin.posts');
    Route::get('activities', ActivityComponent::class)->name('admin.activities');
});


