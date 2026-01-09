<?php

namespace App\Livewire\Admin\Pedoman;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\PedomanAdministrasi;
use App\Models\PedomanPersyaratan;

#[Layout('components.layouts.app')]
#[Title('Pedoman Administrasi')]
class PedomanComponent extends Component
{
    public $action = 'index'; // index | create | edit | show
    public $pedomanId;

    public $nama = '';
    public $deskripsi = '';
    public $status = 'active';
    public $slugPreview = '';

    public array $persyaratans = [];

    public $search = '';
    public $page = 1;

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:active,inactive',

            'persyaratans' => 'array|min:1',
            'persyaratans.*.nama' => 'required|string|max:150',
            'persyaratans.*.deskripsi' => 'nullable|string',
            'persyaratans.*.download_url' => 'nullable|string|max:500',
        ];
    }

    public function mount()
    {
        $this->resetForm();
        $this->action = 'index';
    }

    public function updatingSearch()
    {
        $this->page = 1;
    }

    public function updatedNama()
    {
        $this->slugPreview = Str::slug($this->nama);
    }

    public function back()
    {
        $this->resetForm();
        $this->action = 'index';
    }

    private function resetForm()
    {
        $this->reset([
            'pedomanId',
            'nama',
            'deskripsi',
            'status',
            'slugPreview',
            'persyaratans',
        ]);

        $this->status = 'active';
        $this->persyaratans = [];
        $this->addPersyaratan();
    }

    public function create()
    {
        $this->resetForm();
        $this->action = 'create';
    }

    public function edit(string $id)
    {
        $p = PedomanAdministrasi::with('persyaratans')->findOrFail($id);

        $this->pedomanId = $p->id;
        $this->nama = $p->nama;
        $this->deskripsi = $p->deskripsi ?? '';
        $this->status = $p->status;
        $this->slugPreview = $p->slug;

        $this->persyaratans = $p->persyaratans
            ->sortBy('sort_order')
            ->map(fn ($x) => [
                'id' => $x->id,
                'nama' => $x->nama,
                'deskripsi' => $x->deskripsi,
                'download_url' => $x->download_url,
                'sort_order' => (int) $x->sort_order,
            ])->values()->toArray();

        if (count($this->persyaratans) === 0) {
            $this->addPersyaratan();
        }

        $this->action = 'edit';
    }

    public function show(string $id)
    {
        $this->pedomanId = $id;
        $this->action = 'show';
    }

    public function addPersyaratan()
    {
        $this->persyaratans[] = [
            'id' => null,
            'nama' => '',
            'deskripsi' => '',
            'download_url' => '',
            'sort_order' => count($this->persyaratans),
        ];
    }

    public function removePersyaratan(int $index)
    {
        unset($this->persyaratans[$index]);
        $this->persyaratans = array_values($this->persyaratans);

        foreach ($this->persyaratans as $i => $row) {
            $this->persyaratans[$i]['sort_order'] = $i;
        }
    }

    private function makeUniqueSlug(string $nama, ?string $ignoreId = null): string
    {
        $base = Str::slug($nama);
        $slug = $base ?: Str::random(8);
        $i = 1;

        while (PedomanAdministrasi::query()
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()
        ) {
            $slug = ($base ?: 'pedoman') . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $pedoman = new PedomanAdministrasi();
            $pedoman->id = (string) Str::uuid();
            $pedoman->nama = $this->nama;
            $pedoman->deskripsi = $this->deskripsi;
            $pedoman->status = $this->status;
            $pedoman->slug = $this->makeUniqueSlug($this->nama);
            $pedoman->save();

            foreach ($this->persyaratans as $i => $row) {
                PedomanPersyaratan::create([
                    'id' => (string) Str::uuid(),
                    'pedoman_administrasi_id' => $pedoman->id,
                    'nama' => $row['nama'],
                    'deskripsi' => $row['deskripsi'] ?? null,
                    'download_url' => $row['download_url'] ?? null,
                    'sort_order' => $i,
                ]);
            }
        });

        session()->flash('success', 'Pedoman berhasil dibuat!');
        return $this->redirectRoute('admin.pedoman', navigate: true);
    }

    public function update()
    {
        $this->validate();

        DB::transaction(function () {
            $pedoman = PedomanAdministrasi::with('persyaratans')->findOrFail($this->pedomanId);

            $pedoman->nama = $this->nama;
            $pedoman->deskripsi = $this->deskripsi;
            $pedoman->status = $this->status;

            // slug ikut nama dan dijamin unik
            $pedoman->slug = $this->makeUniqueSlug($this->nama, $pedoman->id);
            $pedoman->save();

            $incomingIds = collect($this->persyaratans)->pluck('id')->filter()->values();

            // ✅ PERBAIKAN: hapus baris lama yang tidak ada di form
            $q = PedomanPersyaratan::where('pedoman_administrasi_id', $pedoman->id);
            if ($incomingIds->count() > 0) {
                $q->whereNotIn('id', $incomingIds);
            }
            $q->delete();

            // ✅ upsert
            foreach ($this->persyaratans as $i => $row) {
                $data = [
                    'pedoman_administrasi_id' => $pedoman->id,
                    'nama' => $row['nama'],
                    'deskripsi' => $row['deskripsi'] ?? null,
                    'download_url' => $row['download_url'] ?? null,
                    'sort_order' => $i,
                ];

                if (!empty($row['id'])) {
                    PedomanPersyaratan::where('id', $row['id'])->update($data);
                } else {
                    PedomanPersyaratan::create(array_merge($data, [
                        'id' => (string) Str::uuid(),
                    ]));
                }
            }
        });

        session()->flash('success', 'Pedoman berhasil diperbarui!');
        return $this->redirectRoute('admin.pedoman', navigate: true);
    }

    public function delete(string $id)
    {
        $p = PedomanAdministrasi::find($id);

        if ($p) {
            $p->delete(); // cascade persyaratan
            session()->flash('success', 'Pedoman berhasil dihapus!');
            return $this->redirectRoute('admin.pedoman', navigate: true);
        }

        session()->flash('warning', 'Data tidak ditemukan.');
        return $this->redirectRoute('admin.pedoman', navigate: true);
    }

    private function getFiltered()
    {
        $query = PedomanAdministrasi::withCount('persyaratans')->latest()->get();

        if ($this->search) {
            $s = strtolower($this->search);
            $query = $query->filter(fn($p) =>
                str_contains(strtolower($p->nama ?? ''), $s) ||
                str_contains(strtolower($p->slug ?? ''), $s)
            );
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

    public function render()
    {
        return match ($this->action) {
            'create' => view('livewire.admin.pedoman.create'),
            'edit' => view('livewire.admin.pedoman.edit', [
                'pedoman' => PedomanAdministrasi::with('persyaratans')->findOrFail($this->pedomanId)
            ]),
            'show' => view('livewire.admin.pedoman.show', [
                'pedoman' => PedomanAdministrasi::with('persyaratans')->findOrFail($this->pedomanId)
            ]),
            default => view('livewire.admin.pedoman.index', [
                'items' => $this->getFiltered()
            ]),
        };
    }
}
