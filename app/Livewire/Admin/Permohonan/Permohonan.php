<?php

namespace App\Livewire\Admin\Permohonan;

use Livewire\Component;
use App\Models\Permohonan as PermohonanModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.app')]
#[Title('Layanan Permohonan')]
class Permohonan extends Component
{
    public $search = '';
    public $page = 1;

    // ✅ Detail Modal
    public $showDetailModal = false;
    public $detailPermohonan = null;

    /** Reset pagination */
    public function resetPage()
    {
        $this->page = 1;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /** ✅ Show detail */
    public function detail($id)
    {
        $data = PermohonanModel::find($id);

        if (!$data) {
            session()->flash('warning', 'Data permohonan tidak ditemukan.');
            return;
        }

        $this->detailPermohonan = $data;
        $this->showDetailModal = true;
    }

    /** ✅ Close detail */
    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailPermohonan = null;
    }

    /** Delete permohonan */
    public function delete($id)
    {
        $permohonan = PermohonanModel::find($id);

        if ($permohonan) {
            $permohonan->delete();
            session()->flash('success', 'Permohonan berhasil dihapus!');
            return $this->redirectRoute('admin.permohonan', navigate: true);
        }

        session()->flash('warning', 'Data permohonan tidak ditemukan.');
        return $this->redirectRoute('admin.permohonan', navigate: true);
    }

    /** Render view */
    public function render()
    {
        return view('livewire.admin.permohonan.index', [
            'permohonans' => $this->getFilteredPermohonans()
        ]);
    }

    /** Custom pagination with search */
    private function getFilteredPermohonans()
    {
        $query = PermohonanModel::latest()->get();

        if ($this->search) {
            $searchLower = strtolower($this->search);

            $query = $query->filter(function ($p) use ($searchLower) {
                return str_contains(strtolower($p->nama_lengkap ?? ''), $searchLower)
                    || str_contains(strtolower($p->nomor_hp ?? ''), $searchLower)
                    || str_contains(strtolower($p->kebutuhan ?? ''), $searchLower);
            });
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
