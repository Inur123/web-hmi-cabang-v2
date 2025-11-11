<!-- filepath: resources/views/livewire/admin/posts/index.blade.php -->
<div>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Daftar Post</h1>
        <p class="text-sm text-gray-600 mt-1">Kelola semua post</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Post</label>
                <input type="text" wire:model.live="search" placeholder="Judul post..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm">
            </div>
            <div class="flex items-end">
                <button wire:click="create"
                    class="w-full bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition text-sm">
                    <i class="fas fa-plus mr-2"></i>Tambah Post
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b border-gray-100">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800">Post Tersedia</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 w-16">No</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Thumbnail</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Judul Post</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Tanggal Dibuat</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">View</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($posts as $index => $post)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $posts->firstItem() + $index }}</td>
                            <td class="py-3 px-4">
                                @if ($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail"
                                        class="w-12 h-12 object-cover rounded">
                                @else
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm font-medium text-gray-800">{{ $post->title }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $post->category->name ?? '-' }}</td>
                            <td class="py-3 px-4 text-sm">
                                @if ($post->status === 'active')
                                    <span class="text-white bg-teal-600 px-2 py-1 rounded text-xs">Active</span>
                                @else
                                    <span class="text-gray-700 bg-gray-200 px-2 py-1 rounded text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-700">
                                {{ $post->post_date ? \Carbon\Carbon::parse($post->post_date)->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ $post->view }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <!-- Show Button -->
                                    <button wire:click="show('{{ $post->id }}')"
                                        class="text-blue-600 hover:text-blue-800 transition" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Edit Button -->
                                    <button wire:click="edit('{{ $post->id }}')"
                                        class="text-yellow-600 hover:text-yellow-800 transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button onclick="confirmDeletePost('{{ $post->id }}', '{{ addslashes($post->title) }}')"
                                        class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                                <p>Belum ada post</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        @if ($posts->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ $posts->firstItem() }}</span>
                        sampai <span class="font-medium">{{ $posts->lastItem() }}</span>
                        dari <span class="font-medium">{{ $posts->total() }}</span> hasil
                    </div>
                    <div class="flex items-center gap-2">
                        @if ($posts->onFirstPage())
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <button wire:click="$set('page', {{ $posts->currentPage() - 1 }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        @endif

                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                            @if ($page == $posts->currentPage())
                                <span class="px-4 py-2 text-sm text-white bg-teal-600 rounded-lg font-medium">
                                    {{ $page }}
                                </span>
                            @else
                                <button wire:click="$set('page', {{ $page }})" wire:loading.attr="disabled"
                                    class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach

                        @if ($posts->hasMorePages())
                            <button wire:click="$set('page', {{ $posts->currentPage() + 1 }})"
                                wire:loading.attr="disabled"
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
    function confirmDeletePost(id, title) {
        Swal.fire({
            title: 'Hapus Post?',
            html: `Post <strong>${title}</strong> akan dihapus secara permanen!`,
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
