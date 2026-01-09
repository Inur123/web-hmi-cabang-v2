<div>
    <div class="mb-6 flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Pedoman Administrasi</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola pedoman dan persyaratan</p>
        </div>

        <button wire:click="create"
            class="px-4 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm transition">
            <i class="fas fa-plus mr-2"></i>Tambah Pedoman
        </button>
    </div>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
        <input type="text" wire:model.live="search" placeholder="Nama / slug..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm">
    </div>


    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-100">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">Daftar Pedoman</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 w-16">No</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nama</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Persyaratan</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($items as $index => $it)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $items->firstItem() + $index }}</td>

                            <td class="py-3 px-4">
                                <div class="text-sm font-medium text-gray-800 max-w-[450px] truncate">{{ $it->nama }}</div>
                                @if ($it->deskripsi)
                                    <div class="text-xs text-gray-500 max-w-[420px] truncate"
                                        title="{{ $it->deskripsi }}">
                                        {{ \Illuminate\Support\Str::limit($it->deskripsi, 70) }}
                                    </div>
                                @endif
                            </td>



                            <td class="py-3 px-4 text-sm">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $it->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $it->status }}
                                </span>
                            </td>

                            <td class="py-3 px-4 text-sm text-gray-700">{{ $it->persyaratans_count ?? 0 }}</td>

                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ $it->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <button wire:click="show('{{ $it->id }}')"
                                        class="text-teal-600 hover:text-teal-800 transition" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button wire:click="edit('{{ $it->id }}')"
                                        class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button
                                        onclick="confirmDeletePedoman('{{ $it->id }}','{{ addslashes($it->nama) }}')"
                                        class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 px-4 text-center text-gray-500">
                                Belum ada pedoman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- pagination custom --}}
        @if ($items->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $items->firstItem() }}</span>
                        sampai <span class="font-medium">{{ $items->lastItem() }}</span>
                        dari <span class="font-medium">{{ $items->total() }}</span> hasil
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($items->onFirstPage())
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <button wire:click="$set('page', {{ $items->currentPage() - 1 }})"
                                class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        @endif

                        @foreach ($items->getUrlRange(1, $items->lastPage()) as $p => $url)
                            @if ($p == $items->currentPage())
                                <span class="px-4 py-2 text-sm text-white bg-teal-600 rounded-lg font-medium">
                                    {{ $p }}
                                </span>
                            @else
                                <button wire:click="$set('page', {{ $p }})"
                                    class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                    {{ $p }}
                                </button>
                            @endif
                        @endforeach

                        @if ($items->hasMorePages())
                            <button wire:click="$set('page', {{ $items->currentPage() + 1 }})"
                                class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @else
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function confirmDeletePedoman(id, nama) {
        Swal.fire({
            title: 'Hapus Pedoman?',
            html: `Pedoman <strong>${nama}</strong> akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#14b8a6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true
        }).then((r) => {
            if (r.isConfirmed) {
                @this.call('delete', id);
            }
        });
    }
</script>
