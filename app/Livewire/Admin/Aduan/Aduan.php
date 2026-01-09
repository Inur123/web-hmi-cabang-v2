<?php

namespace App\Livewire\Admin\Aduan;

use Livewire\Component;
use App\Models\Aduan as AduanModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.app')]
#[Title('Layanan Aduan')]
class Aduan extends Component
{
    public $search = '';
    public $page = 1;

    /** Reset pagination */
    public function resetPage()
    {
        $this->page = 1;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /** Delete aduan */
    public function delete($id)
    {
        $aduan = AduanModel::find($id);

        if ($aduan) {
            $aduan->delete();
            session()->flash('success', 'Aduan berhasil dihapus!');
            return $this->redirectRoute('admin.aduan', navigate: true);
        }

        session()->flash('warning', 'Data aduan tidak ditemukan.');
        return $this->redirectRoute('admin.aduan', navigate: true);
    }

    /** Render view */
    public function render()
    {
        return view('livewire.admin.aduan.index', [
            'aduans' => $this->getFilteredAduans()
        ]);
    }

    /** Custom pagination with search */
    private function getFilteredAduans()
    {
        $query = AduanModel::latest()->get();

        if ($this->search) {
            $searchLower = strtolower($this->search);
            $query = $query->filter(function ($a) use ($searchLower) {
                return str_contains(strtolower($a->nama_lengkap), $searchLower)
                    || str_contains(strtolower($a->nomor_hp), $searchLower);
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
