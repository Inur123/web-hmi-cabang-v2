<?php

namespace App\Livewire\User\Blog\Category;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.guest')]
#[Title('Category Posts')]
class CategoryShow extends Component
{
    public string $slug;               // slug kategori
    public ?Category $category = null; // data kategori, bisa null di awal
    public int $page = 1;              // halaman saat ini
    public string $search = '';        // search query
    public int $perPage = 10;           // jumlah post per halaman

    /** Reset halaman saat search berubah */
    public function updatingSearch(): void
    {
        $this->page = 1;
    }

    /** Pindah halaman SPA */
    public function gotoPage(int $page): void
    {
        $this->page = $page;
    }

    /** Mount kategori berdasarkan slug */
    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    /** Render view */
    public function render()
    {
        // Jika kategori belum ada, kembalikan koleksi kosong
        if (!$this->category) {
            $posts = new LengthAwarePaginator([], 0, $this->perPage, $this->page, [
                'path' => request()->url()
            ]);

            return view('livewire.user.blog.category.category-show', compact('posts'));
        }

        // Ambil semua post aktif di kategori ini
        $query = Post::where('category_id', $this->category->id)
                     ->where('status', 'active')
                     ->latest('post_date')
                     ->get();

        // Filter jika ada search
        if ($this->search) {
            $searchLower = strtolower($this->search);
            $query = $query->filter(fn($post) => str_contains(strtolower($post->title), $searchLower));
        }

        // Pagination manual
        $total = $query->count();
        $items = $query->slice(($this->page - 1) * $this->perPage, $this->perPage)->values();

        $posts = new LengthAwarePaginator(
            $items,
            $total,
            $this->perPage,
            $this->page,
            ['path' => request()->url()]
        );

        return view('livewire.user.blog.category.category-show', compact('posts'));
    }
}
