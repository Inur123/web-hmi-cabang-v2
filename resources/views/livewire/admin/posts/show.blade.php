<div class="max-w-5xl mx-auto">
    <!-- Back Button & Title -->
    <div class="flex items-center justify-between mb-8">
        <button wire:click="back"
            class="flex items-center bg-teal-600 text-white hover:bg-teal-700 transition-all duration-300 text-sm font-medium px-3 py-1.5 rounded-lg cursor-pointer shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </button>

        <div class="text-right">
            <span
                class="inline-block px-3 py-1 text-xs font-medium rounded-full
                @if ($post->status === 'active') bg-teal-700 text-white
                @else bg-red-500 text-white @endif">
                {{ ucfirst($post->status) }}
            </span>
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Thumbnail Header -->
        @if ($post->thumbnail)
            <div class="relative h-64 md:h-80 overflow-hidden bg-gray-50">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-4 left-6 right-6 text-white">
                    <h1 class="text-2xl md:text-3xl font-bold leading-tight">{{ $post->title }}</h1>
                </div>
            </div>
        @else
            <div class="h-48 bg-gradient-to-br from-teal-50 to-teal-100 flex items-center justify-center">
                <div class="text-center">
                    <i class="fas fa-image text-6xl text-teal-200 mb-2"></i>
                    <p class="text-teal-600 font-medium">Tanpa Thumbnail</p>
                </div>
            </div>
        @endif

        <!-- Content Body -->
        <div class="p-6 md:p-8">
            <!-- Post Metadata -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 text-sm text-gray-600">
                <div>
                    <div class="flex items-center mb-3">
                        <i class="fas fa-folder-open w-5 h-5 text-teal-600 mr-2"></i>
                        <span class="font-medium text-gray-700">Kategori:</span>
                        <span class="ml-2">{{ $post->category->name ?? '-' }}</span>
                    </div>
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calendar-alt w-5 h-5 text-teal-600 mr-2"></i>
                        <span class="font-medium text-gray-700">Tanggal Dibuat:</span>
                        <span class="ml-2">
                            {{ $post->post_date ? \Carbon\Carbon::parse($post->post_date)->translatedFormat('d F Y') : '-' }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-eye w-5 h-5 text-teal-600 mr-2"></i>
                        <span class="font-medium text-gray-700">Dilihat:</span>
                        <span class="ml-2 font-semibold text-teal-600">{{ number_format($post->view) }} kali</span>
                    </div>
                </div>
                <div>
                    <div class="flex items-center mb-3">
                        <i class="fas fa-clock w-5 h-5 text-teal-600 mr-2"></i>
                        <span class="font-medium text-gray-700">Dibuat pada:</span>
                        <span class="ml-2">
                            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y, H:i') }}
                        </span>
                    </div>
                    @if ($post->updated_at > $post->created_at)
                        <div class="flex items-center">
                            <i class="fas fa-sync-alt w-5 h-5 text-orange-500 mr-2"></i>
                            <span class="font-medium text-gray-700">Diperbarui:</span>
                            <span class="ml-2 text-orange-600">
                                {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tags -->
            @if ($post->tags->count())
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-tags mr-2 text-teal-600"></i> Tag
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-700">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif


            <!-- Content -->
            <div class="prose prose-sm md:prose lg:prose-lg max-w-none mb-8">
                @if ($post->content)
                    {!! $post->content !!}
                @else
                    <p class="text-gray-400 italic">Tidak ada konten.</p>
                @endif
            </div>

            <!-- Gallery Section -->
            @if ($post->galleries->count())
                <div class="mt-10">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-teal-600"></i> Galeri ({{ $post->galleries->count() }})
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($post->galleries as $gallery)
                            <div
                                class="group relative overflow-hidden rounded-lg shadow-sm hover:shadow-md transition-shadow bg-gray-100">

                                <!-- Box ukuran tetap -->
                                <div class="w-full h-40 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery"
                                        class="max-w-full max-h-full object-contain transition-transform duration-300 group-hover:scale-105"
                                        onerror="this.src='{{ asset('images/no-foto.png') }}'" />
                                </div>

                                <!-- Overlay hover -->
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-10 pt-6 border-t border-gray-200">
                <button wire:click="edit('{{ $post->id }}')"
                    class="flex-1 sm:flex-initial px-5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg transition flex items-center justify-center cursor-pointer">
                    <i class="fas fa-edit mr-2"></i> Edit Post
                </button>
                <button onclick="confirmDeletePost('{{ $post->id }}', '{{ addslashes($post->title) }}')"
                    class="flex-1 sm:flex-initial px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition flex items-center justify-center cursor-pointer">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Reusable Delete Confirmation (same as index) --}}
<script>
    function confirmDeletePost(id, title) {
        Swal.fire({
            title: 'Hapus Post?',
            html: `Post <strong>${title}</strong> akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
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
