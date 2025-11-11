<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\PostGallery;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.app')]
#[Title('Pos')]
class PostComponent extends Component
{
    use WithFileUploads;

    public $action = 'index';
    public $postId;

    public $title;
    public $category_id;
    public $status = 'inactive';
    public $thumbnailTemp;
    public $thumbnail;
    public $content = ''; // Inisialisasi dengan string kosong
    public $tags = [];
    public $tagsString = '';
    public $galleries = [];
    public $search = '';
    public $page = 1;
    public $post_date;
    public $galleryInputs = [];
    public $removedGalleries = [];

    public $allCategories;
    public $allTags;

    protected $rules = [
        'title' => 'required|string|max:255',
        'category_id' => 'required',
        'status' => 'required|in:active,inactive',
        'content' => 'nullable|string',
        'tagsString' => 'nullable|string',
        'thumbnailTemp' => 'nullable|image|max:5120',
        'galleryInputs.*' => 'nullable|image|max:5120',
        'post_date' => 'nullable|date',
    ];

    public function mount()
    {
        $this->allCategories = Category::all();
        $this->allTags = Tag::all();
    }

    public function updatingSearch()
    {
        $this->page = 1;
    }

    public function back()
    {
        $this->resetForm();
        $this->action = 'index';
    }

    private function resetForm()
    {
        $this->reset([
            'title',
            'category_id',
            'status',
            'content',
            'tags',
            'tagsString',
            'thumbnail',
            'thumbnailTemp',
            'galleries',
            'galleryInputs',
            'postId',
            'post_date',
            'removedGalleries'
        ]);

        // Reset content ke string kosong
        $this->content = '';
    }

    public function create()
    {
        $this->resetForm();
        $this->action = 'create';
    }

    public function edit($id)
    {
        $post = Post::with('tags', 'galleries')->findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->category_id = $post->category_id;
        $this->status = $post->status;
        $this->content = $post->content ?? ''; // Pastikan tidak null
        $this->tags = $post->tags->pluck('name')->toArray();
        $this->tagsString = implode(', ', $this->tags);
        $this->galleries = $post->galleries->pluck('image')->toArray();
        $this->thumbnail = $post->thumbnail;
        $this->post_date = $post->post_date;
        $this->galleryInputs = [];
        $this->removedGalleries = [];
        $this->action = 'edit';
    }

    public function show($id)
    {
        $this->postId = $id;
        $this->action = 'show';
    }

    public function save()
    {
        $this->validate();
        $tagsArray = array_filter(array_map('trim', explode(',', $this->tagsString)));

        $post = Post::create([
            'title' => $this->title,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'content' => $this->content,
            'post_date' => $this->post_date,
            'thumbnail' => $this->thumbnailTemp ? $this->thumbnailTemp->store('posts/thumbnails', 'public') : null
        ]);

        $this->syncTags($post, $tagsArray);
        $this->saveGalleries($post);

        session()->flash('success', 'Post berhasil dibuat!');
        return $this->redirectRoute('admin.posts', navigate: true);
    }

    public function update()
    {
        $this->validate();
        $post = Post::findOrFail($this->postId);
        $tagsArray = array_filter(array_map('trim', explode(',', $this->tagsString)));

        if ($this->thumbnailTemp) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $post->thumbnail = $this->thumbnailTemp->store('posts/thumbnails', 'public');
        }

        $post->update([
            'title' => $this->title,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'content' => $this->content,
            'post_date' => $this->post_date,
            'thumbnail' => $post->thumbnail
        ]);

        $this->syncTags($post, $tagsArray);
        $this->removeSelectedGalleries($post);
        $this->saveGalleries($post);

        session()->flash('success', 'Post berhasil diperbarui!');
        return $this->redirectRoute('admin.posts', navigate: true);
    }

    private function syncTags($post, $tagsArray)
    {
        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            if (!empty($tagName)) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        $post->tags()->sync($tagIds);
    }

    private function saveGalleries($post)
    {
        foreach ($this->galleryInputs as $galleryImage) {
            if ($galleryImage) {
                $path = $galleryImage->store('posts/gallery', 'public');
                PostGallery::create(['post_id' => $post->id, 'image' => $path]);
            }
        }
    }

    private function removeSelectedGalleries($post)
    {
        foreach ($this->removedGalleries as $path) {
            $gallery = PostGallery::where('post_id', $post->id)
                                 ->where('image', $path)
                                 ->first();
            if ($gallery) {
                Storage::disk('public')->delete($gallery->image);
                $gallery->delete();
            }
        }
        $this->removedGalleries = [];
    }

    public function addGalleryInput()
    {
        $this->galleryInputs[] = null;
    }

    public function removeGalleryInput($index)
    {
        unset($this->galleryInputs[$index]);
        $this->galleryInputs = array_values($this->galleryInputs);
    }

    public function removeGalleryExisting($index)
    {
        if (isset($this->galleries[$index])) {
            $this->removedGalleries[] = $this->galleries[$index];
            unset($this->galleries[$index]);
            $this->galleries = array_values($this->galleries);
        }
    }

    private function getFilteredPosts()
    {
        $query = Post::latest()->get();

        if ($this->search) {
            $searchLower = strtolower($this->search);
            $query = $query->filter(fn($p) => str_contains(strtolower($p->title), $searchLower));
        }

        $perPage = 10;
        $currentPage = $this->page;
        $total = $query->count();
        $items = $query->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );
    }

    public function delete($id)
    {
        $post = Post::with('tags', 'galleries')->findOrFail($id);

        // Hapus relasi tag di pivot table
        $tags = $post->tags;
        $post->tags()->detach();

        // Hapus tag yang tidak dimiliki post lain
        foreach ($tags as $tag) {
            if ($tag->posts()->count() === 0) {
                $tag->delete();
            }
        }

        // Hapus gallery terkait
        foreach ($post->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
            $gallery->delete();
        }

        // Hapus thumbnail jika ada
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Hapus post
        $post->delete();

        session()->flash('success', 'Post berhasil dihapus!');
        return $this->redirectRoute('admin.posts', navigate: true);
    }

    public function render()
    {
        return match ($this->action) {
            'create' => view('livewire.admin.posts.create'),
            'edit' => view('livewire.admin.posts.edit', [
                'post' => Post::with('tags', 'galleries')->findOrFail($this->postId)
            ]),
            'show' => view('livewire.admin.posts.show', [
                'post' => Post::with('tags', 'galleries', 'category')->findOrFail($this->postId)
            ]),
            default => view('livewire.admin.posts.index', [
                'posts' => $this->getFilteredPosts()
            ])
        };
    }
}
