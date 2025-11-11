<?php

namespace App\Livewire\User\Blog\Sidebar;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Category;
use App\Models\Post;

#[Layout('components.layouts.app')]
#[Title('Pos')]
class SidebarBlog extends Component
{
    public $categories;
    public $popularPosts;
    public $totalCategoriesCount;

    public function mount()
    {
        // Ambil semua kategori
        $this->categories = Category::orderBy('name')->get();

        // Ambil 5 post terpopuler berdasarkan view (kolom 'view' di database)
        $this->popularPosts = Post::orderByDesc('view')->take(5)->get();

        // Total kategori
        $this->totalCategoriesCount = $this->categories->count();
    }

    public function render()
    {
        return view('livewire.user.blog.sidebar.sidebar-blog', [
            'categories' => $this->categories,
            'popularPosts' => $this->popularPosts,
            'totalCategoriesCount' => $this->totalCategoriesCount,
        ]);
    }
}
