<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

use App\Livewire\User\Home as UserHome;
use App\Livewire\User\Komisariat;
use App\Livewire\User\Blog\BlogMenu;
use App\Livewire\User\Blog\BlogDetail;
use App\Livewire\User\Blog\Category\CategoryShow;
use App\Livewire\User\Profile\Sejarah;
use App\Livewire\User\Profile\Kepengurusan;
use App\Livewire\User\Aduan\Aduan as UserAduan;
use App\Livewire\User\Permohonan\Permohonan as UserPermohonan;
use App\Livewire\User\Layanan\PedomanAdministrasi;

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Posts\PostComponent;
use App\Livewire\Admin\Posts\Category as AdminCategory;
use App\Livewire\Admin\Activities\ActivityComponent;
use App\Livewire\Admin\Aduan\Aduan as AduanAdmin;
use App\Livewire\Admin\Permohonan\Permohonan as PermohonanAdmin;
use App\Livewire\Admin\Pedoman\PedomanComponent;


// =======================
// USER ROUTES
// =======================
Route::get('/', UserHome::class)->name('home');
Route::get('/komisariat', Komisariat::class)->name('komisariat.index');

Route::get('/blog', BlogMenu::class)->name('blog');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.show');
Route::get('/blog/{category:slug}', BlogMenu::class)->name('blog.category');
Route::get('/categories/{slug}', CategoryShow::class)->name('categories.show');

Route::get('/profile/sejarah', Sejarah::class)->name('profile.sejarah');
Route::get('/profile/kepengurusan', Kepengurusan::class)->name('profile.kepengurusan');

Route::get('/layanan/pedoman-administrasi', PedomanAdministrasi::class)
    ->name('layanan.pedoman');

Route::get('/layanan/pedoman-administrasi/{slug}', PedomanAdministrasi::class)
    ->name('layanan.pedoman.detail');


Route::get('/aduan', UserAduan::class)->name('aduan');
Route::get('/permohonan', UserPermohonan::class)->name('permohonan');

Route::get('/login', Login::class)->name('login');
// Route::get('/register', Register::class)->name('register');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/categories', AdminCategory::class)->name('admin.categories');
    Route::get('/posts', PostComponent::class)->name('admin.posts');
    Route::get('/activities', ActivityComponent::class)->name('admin.activities');
    Route::get('/aduan', AduanAdmin::class)->name('admin.aduan');
    Route::get('/permohonan', PermohonanAdmin::class)->name('admin.permohonan');
    Route::get('/pedoman-administrasi', PedomanComponent::class)->name('admin.pedoman');
});
