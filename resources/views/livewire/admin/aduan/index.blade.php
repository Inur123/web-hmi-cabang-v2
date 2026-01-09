<div>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Daftar Aduan</h1>
        <p class="text-sm text-gray-600 mt-1">Kelola semua aduan dari pengguna</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Aduan</label>
                <input type="text" wire:model.live="search" placeholder="Nama lengkap / nomor hp..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm">
            </div>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="bg-teal-100 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="bg-yellow-100 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-100">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">Aduan Masuk</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 w-16">No</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nama Lengkap</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nomor HP</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Alamat</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Isi Aduan</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($aduans as $index => $aduan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ $aduans->firstItem() + $index }}
                            </td>

                            <td class="py-3 px-4 text-sm font-medium text-gray-800">
                                {{ $aduan->nama_lengkap }}
                            </td>

                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ $aduan->nomor_hp }}
                            </td>

                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ \Illuminate\Support\Str::limit($aduan->alamat, 50) }}
                            </td>

                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ \Illuminate\Support\Str::limit($aduan->isi_aduan, 60) }}
                            </td>

                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ $aduan->created_at ? $aduan->created_at->format('d M Y') : '-' }}
                            </td>

                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <!-- Delete Button -->
                                    <button onclick="confirmDeleteAduan('{{ $aduan->id }}', '{{ addslashes($aduan->nama_lengkap) }}')"
                                        class="text-red-600 hover:text-red-800 transition cursor-pointer"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                                <p>Belum ada aduan masuk</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        @if ($aduans->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $aduans->firstItem() }}</span>
                        sampai <span class="font-medium">{{ $aduans->lastItem() }}</span>
                        dari <span class="font-medium">{{ $aduans->total() }}</span> hasil
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($aduans->onFirstPage())
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <button wire:click="$set('page', {{ $aduans->currentPage() - 1 }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition cursor-pointer">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        @endif

                        @foreach ($aduans->getUrlRange(1, $aduans->lastPage()) as $page => $url)
                            @if ($page == $aduans->currentPage())
                                <span class="px-4 py-2 text-sm text-white bg-teal-600 rounded-lg font-medium">
                                    {{ $page }}
                                </span>
                            @else
                                <button wire:click="$set('page', {{ $page }})" wire:loading.attr="disabled"
                                    class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition cursor-pointer">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach

                        @if ($aduans->hasMorePages())
                            <button wire:click="$set('page', {{ $aduans->currentPage() + 1 }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition cursor-pointer">
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
    function confirmDeleteAduan(id, nama) {
        Swal.fire({
            title: 'Hapus Aduan?',
            html: `Aduan dari <strong>${nama}</strong> akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#14b8a6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'px-4 py-2 rounded-lg',
                cancelButton: 'px-4 py-2 rounded-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', id);
            }
        });
    }
</script>
