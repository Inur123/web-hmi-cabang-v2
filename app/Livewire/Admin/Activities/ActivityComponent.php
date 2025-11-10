<?php

namespace App\Livewire\Admin\Activities;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Activity as ActivityModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.app')]
#[Title('Kegiatan')]
class ActivityComponent extends Component
{
    use WithFileUploads;

    public $action = 'index'; // index, create, edit
    public $activityId;
    public $name;
    public $description;
    public $image;
    public $search = '';
    public $page = 1;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'name.required' => 'Nama kegiatan harus diisi',
        'description.required' => 'Deskripsi kegiatan harus diisi',
        'image.image' => 'File harus berupa gambar',
        'image.max' => 'Ukuran gambar maksimal 2MB',
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
        $this->reset(['name', 'description', 'image', 'activityId']);
        $this->action = 'create';
    }

    /** Store new activity */
    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('activities', 'public') : null;

        ActivityModel::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Kegiatan berhasil ditambahkan!');
        return $this->redirectRoute('admin.activities', navigate: true);
    }

    /** Show edit form */
    public function edit($id)
    {
        $activity = ActivityModel::findOrFail($id);
        $this->activityId = $id;
        $this->name = $activity->name;
        $this->description = $activity->description;
        $this->action = 'edit';
    }

    /** Update activity */
    public function update()
    {
        $this->validate();

        $activity = ActivityModel::findOrFail($this->activityId);

        $imagePath = $this->image ? $this->image->store('activities', 'public') : $activity->image;

        $activity->update([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        session()->flash('success', 'Kegiatan berhasil diperbarui!');
        return $this->redirectRoute('admin.activities', navigate: true);
    }

    /** Delete activity */
    public function delete($id)
    {
        $activity = ActivityModel::find($id);
        if ($activity) {
            $activity->delete();
            session()->flash('success', 'Kegiatan berhasil dihapus!');
            return $this->redirectRoute('admin.activities', navigate: true);
        }
    }

    /** Back to index */
    public function back()
    {
        $this->action = 'index';
        $this->reset(['name', 'description', 'image', 'activityId']);
    }

    /** Render view */
    public function render()
    {
        return match ($this->action) {
            'create' => view('livewire.admin.activities.create'),
            'edit' => view('livewire.admin.activities.edit', [
                'activity' => ActivityModel::findOrFail($this->activityId)
            ]),
            default => view('livewire.admin.activities.index', [
                'activities' => $this->getFilteredActivities()
            ]),
        };
    }

    /** Custom pagination with search */
    private function getFilteredActivities()
    {
        $query = ActivityModel::latest()->get();

        if ($this->search) {
            $searchLower = strtolower($this->search);
            $query = $query->filter(fn($a) => str_contains(strtolower($a->name), $searchLower));
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
