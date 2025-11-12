<?php

namespace App\Livewire\User\Blog; // tambahkan \Blog di namespace

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.guest')]
#[Title('Blog')]
class BlogMenu extends Component
{
    public $page = 1;        // halaman saat ini
    public $search = '';     // jika ingin search
    public $perPage = 15;     // jumlah post per halaman

    /** Reset halaman saat search berubah */
    public function updatingSearch()
    {
        $this->page = 1;
    }

    /** Pindah halaman SPA */
    public function gotoPage($page)
    {
        $this->page = $page;
    }

    /** Render view */
    public function render()
    {
        $query = Post::with('category')
            ->where('status', 'active')
            ->latest('post_date')
            ->get();

        if ($this->search) {
            $searchLower = strtolower($this->search);
            $query = $query->filter(fn($post) => str_contains(strtolower($post->title), $searchLower));
        }

        $total = $query->count();
        $items = $query->slice(($this->page - 1) * $this->perPage, $this->perPage)->values();

        $posts = new LengthAwarePaginator(
            $items,
            $total,
            $this->perPage,
            $this->page,
            ['path' => request()->url()]
        );

        // ubah path view ke folder blog
        return view('livewire.user.blog.blog-menu', compact('posts'));
    }
}
