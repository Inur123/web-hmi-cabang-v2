<?php

namespace App\Livewire\User\Blog; // tambahkan \Blog di namespace

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;

#[Layout('components.layouts.guest')]
#[Title('Detail Blog')]
class BlogDetail extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
{
    $this->post = Post::with('category')
        ->where('slug', $slug)
        ->where('status', 'active')
        ->firstOrFail();

    // Tambahkan 1 view setiap kali halaman dibuka
    $this->post->increment('view'); // otomatis menambahkan 1 ke kolom 'view'
}

    public function render()
    {
        // ubah path view ke folder blog
        return view('livewire.user.blog.blog-detail', [
            'post' => $this->post
        ]);
    }
}
