<?php

namespace App\Livewire\User\Blog\Sidebar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

#[Layout('components.layouts.app')]
#[Title('Pos')]
class SidebarBlog extends Component
{
    public $categories;
    public $popularPosts;
    public $tags; // Tambah properti untuk tags

    public function mount()
    {
        // Ambil semua kategori
        $this->categories = Category::orderBy('name')->get();

        // Ambil 5 post terpopuler berdasarkan view
        $this->popularPosts = Post::orderByDesc('view')->take(5)->get();

        // Ambil semua tag unik yang pernah digunakan di post
        $this->tags = Tag::whereHas('posts')->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.user.blog.sidebar.sidebar-blog', [
            'categories' => $this->categories,
            'popularPosts' => $this->popularPosts,
            'tags' => $this->tags,
        ]);
    }
}
