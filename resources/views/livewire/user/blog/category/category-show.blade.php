<div>
    <div class="container mx-auto px-6 py-12">
        <!-- Header Section -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ $category->name ?? 'Kategori' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 text-lg">
                {{ $category->description ?? "Kumpulan artikel pada kategori \"{$category->name}\"" }}
            </p>
        </div>

        <!-- Posts Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($posts as $post)
                <article
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-500 transform hover:-translate-y-2 transition-all duration-500">
                    <a href="{{ route('blog.show', $post->slug) }}" wire:navigate class="block">

                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 right-4">
                                <span
                                    class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-600 to-teal-600 text-white shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Admin Badge -->
                            <!-- Admin Badge + Tanggal -->
                            <div class="flex items-center gap-2 mb-3">
                                <!-- Badge -->
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-r from-green-600 to-teal-600 flex items-center justify-center text-white font-bold text-xs shadow-md">
                                    A
                                </div>
                                <!-- Admin -->
                                <span class="font-medium text-gray-900 dark:text-white">Admin</span>
                                <!-- Tanggal -->
                                <span class="text-gray-500 dark:text-gray-400 text-sm">
                                    {{ \Carbon\Carbon::parse($post->post_date)->format('d M Y') }}
                                </span>
                            </div>


                            <!-- Title -->
                            <h2
                                class="text-xl font-bold mb-3 line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300 text-gray-900 dark:text-white">
                                {!! $post->title !!}
                            </h2>

                            <!-- Content -->
                            <p class="text-gray-600 dark:text-gray-300 line-clamp-3 mb-4">
                                {!! \Illuminate\Support\Str::limit(strip_tags($post->content), 120) !!}
                            </p>

                            <!-- Read More -->
                            <div
                                class="flex items-center text-green-600 dark:text-green-400 font-semibold group-hover:gap-2 transition-all duration-300">
                                <span>Baca Selengkapnya</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transform group-hover:translate-x-2 transition-transform duration-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </div>

                    </a>
                </article>
            @empty
                <div class="text-center py-20 col-span-3">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-600 dark:text-gray-400">Artikel akan segera ditambahkan</p>
                </div>
            @endforelse
        </div>

        <!-- Custom SPA Pagination -->
        <!-- Custom SPA Pagination -->
        @if ($posts->total() > 0)
            <div class="flex justify-center mt-12 space-x-2">
                {{-- Previous --}}
                @if ($posts->onFirstPage())
                    <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">&laquo;</span>
                @else
                    <button wire:click="gotoPage({{ $posts->currentPage() - 1 }})"
                        class="px-4 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 transition">&laquo;</button>
                @endif

                {{-- Page Numbers --}}
                @foreach (range(1, $posts->lastPage()) as $page)
                    @if ($page === $posts->currentPage())
                        <span class="px-4 py-2 rounded-lg bg-green-500 text-white">{{ $page }}</span>
                    @else
                        <button wire:click="gotoPage({{ $page }})"
                            class="px-4 py-2 rounded-lg bg-white text-gray-700 border border-gray-300 hover:bg-green-100 transition">{{ $page }}</button>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($posts->hasMorePages())
                    <button wire:click="gotoPage({{ $posts->currentPage() + 1 }})"
                        class="px-4 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 transition">&raquo;</button>
                @else
                    <span class="px-4 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">&raquo;</span>
                @endif
            </div>
        @endif


    </div>
</div>
