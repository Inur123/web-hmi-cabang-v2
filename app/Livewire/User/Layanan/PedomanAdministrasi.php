<?php

namespace App\Livewire\User\Layanan;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\PedomanAdministrasi as PedomanAdministrasiModel;

#[Layout('components.layouts.guest')]
#[Title('Pedoman Administrasi')]
class PedomanAdministrasi extends Component
{
    // view state
    public string $view = 'index'; // index | detail
    public ?string $slug = null;

    // pagination
    public $page = 1;

    // detail (array biar aman di blade)
    public array $detail = [];

    public function mount(?string $slug = null)
    {
        $this->slug = $slug;

        if ($slug) {
            $this->loadDetailBySlug($slug);
        } else {
            $this->view = 'index';
        }
    }

    // dipakai di halaman detail (tombol back)
    public function goIndex()
    {
        $this->view = 'index';
        $this->slug = null;
        $this->detail = [];

        return $this->redirectRoute('layanan.pedoman', navigate: true);
    }

    private function loadDetailBySlug(string $slug): void
    {
        $p = PedomanAdministrasiModel::with(['persyaratans' => function ($q) {
                $q->orderBy('sort_order');
            }])
            ->where('status', 'active')
            ->where('slug', $slug)
            ->first();

        if (!$p) {
            $this->view = 'index';
            $this->detail = [];
            $this->slug = null;
            return;
        }

        $this->detail = [
            'id' => $p->id,
            'nama' => $p->nama,
            'slug' => $p->slug,
            'deskripsi' => $p->deskripsi,
            'created_at' => $p->created_at?->format('d M Y H:i') ?? '-',
            'persyaratans' => $p->persyaratans->map(fn ($x) => [
                'nama' => $x->nama,
                'deskripsi' => $x->deskripsi,
                'download_url' => $x->download_url,
            ])->toArray(),
        ];

        $this->view = 'detail';
    }

    private function getItems()
    {
        $query = PedomanAdministrasiModel::withCount('persyaratans')
            ->where('status', 'active')
            ->latest()
            ->get();

        $perPage = 9;
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
        return match ($this->view) {
            'detail' => view('livewire.user.layanan.pedoman-administrasi.detail', [
                'detail' => $this->detail,
            ]),
            default => view('livewire.user.layanan.pedoman-administrasi.index', [
                'items' => $this->getItems(),
            ]),
        };
    }
}
