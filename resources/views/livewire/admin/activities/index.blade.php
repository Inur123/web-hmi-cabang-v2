<div>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Kegiatan</h1>
        <p class="text-sm text-gray-600 mt-1">Kelola data kegiatan</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kegiatan</label>
                <input type="text" wire:model.live="search" placeholder="Nama kegiatan..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm">
            </div>
            <div class="flex items-end">
                <button wire:click="create"
                    class="w-full bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition text-sm cursor-pointer">
                    <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-100">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">Daftar Kegiatan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 w-16">No</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nama</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Gambar</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Tanggal Dibuat</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($activities as $index => $activity)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $activities->firstItem() + $index }}</td>
                            <td class="py-3 px-4">
                                <span class="text-sm font-medium text-gray-800">{{ $activity->name }}</span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ \Illuminate\Support\Str::limit($activity->description, 50) }}
                            </td>
                            <td class="py-3 px-4">
                                @if ($activity->image)
                                    <img src="{{ asset('storage/' . $activity->image) }}" alt="Gambar"
                                        class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-xs text-gray-400">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ $activity->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <button wire:click="edit('{{ $activity->id }}')"
                                        class="text-yellow-600 hover:text-yellow-800 transition cursor-pointer"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        onclick="confirmDeleteActivity('{{ $activity->id }}', '{{ $activity->name }}')"
                                        class="text-red-600 hover:text-red-800 transition cursor-pointer"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                                <p>Belum ada kegiatan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        @if ($activities->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Info -->
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $activities->firstItem() }}</span>
                        sampai <span class="font-medium">{{ $activities->lastItem() }}</span>
                        dari <span class="font-medium">{{ $activities->total() }}</span> hasil
                    </div>
                    <!-- Pagination Buttons -->
                    <div class="flex items-center gap-2">
                        @if ($activities->onFirstPage())
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <button wire:click="$set('page', {{ $activities->currentPage() - 1 }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition cursor-pointer">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        @endif

                        @foreach ($activities->getUrlRange(1, $activities->lastPage()) as $page => $url)
                            @if ($page == $activities->currentPage())
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

                        @if ($activities->hasMorePages())
                            <button wire:click="$set('page', {{ $activities->currentPage() + 1 }})"
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
    function confirmDeleteActivity(id, name) {
        Swal.fire({
            title: 'Hapus Kegiatan?',
            html: `Kegiatan <strong>${name}</strong> akan dihapus secara permanen!`,
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
