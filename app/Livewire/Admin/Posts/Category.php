<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Category as CategoryModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.app')]
#[Title('Kategori Post')]
class Category extends Component
{
    public $action = 'index'; // index, create, edit
    public $categoryId;
    public $name;
    public $search = '';
    public $page = 1; // Custom pagination

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'Nama kategori harus diisi',
        'name.max' => 'Nama kategori maksimal 255 karakter',
    ];

    /** Reset pagination */
    public function resetPage()
    {
        $this->page = 1;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /** Show create form */
    public function create()
    {
        $this->reset(['name', 'categoryId']);
        $this->action = 'create';
    }

    /** Store new category */
    public function save()
    {
        $this->validate();

        $exists = CategoryModel::whereRaw('LOWER(name) = ?', [strtolower($this->name)])->exists();
        if ($exists) {
            $this->addError('name', 'Nama kategori sudah digunakan');
            return;
        }

        CategoryModel::create(['name' => $this->name]);

        // Flash message seperti login
        session()->flash('success', 'Kategori berhasil ditambahkan!');

        // SPA redirect ke index agar flash muncul
        return $this->redirectRoute('admin.categories', navigate: true);
    }

    /** Show edit form */
    public function edit($id)
    {
        $category = CategoryModel::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->action = 'edit';
    }

    /** Update category */
    public function update()
    {
        $this->validate();

        $exists = CategoryModel::where('id', '!=', $this->categoryId)
            ->whereRaw('LOWER(name) = ?', [strtolower($this->name)])
            ->exists();

        if ($exists) {
            $this->addError('name', 'Nama kategori sudah digunakan');
            return;
        }

        $category = CategoryModel::findOrFail($this->categoryId);
        $category->update(['name' => $this->name]);

        session()->flash('success', 'Kategori berhasil diperbarui!');
        return $this->redirectRoute('admin.categories', navigate: true);
    }

    /** Delete category */
    public function delete($id)
    {
        $category = CategoryModel::find($id);
        if ($category) {
            $category->delete();
            session()->flash('success', 'Kategori berhasil dihapus!');
            return $this->redirectRoute('admin.categories', navigate: true);
        }
    }

    /** Back to index */
    public function back()
    {
        $this->action = 'index';
        $this->reset(['name', 'categoryId']);
    }

    /** Render view */
    public function render()
    {
        return match ($this->action) {
            'create' => view('livewire.admin.posts.category.create'),
            'edit' => view('livewire.admin.posts.category.edit', [
                'category' => CategoryModel::findOrFail($this->categoryId)
            ]),
            default => view('livewire.admin.posts.category.index', [
                'categories' => $this->getFilteredCategories()
            ]),
        };
    }

    /** Custom pagination with search */
    private function getFilteredCategories()
    {
        $query = CategoryModel::latest()->get();

        if ($this->search) {
            $searchLower = strtolower($this->search);
            $query = $query->filter(fn($c) => str_contains(strtolower($c->name), $searchLower));
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
}
