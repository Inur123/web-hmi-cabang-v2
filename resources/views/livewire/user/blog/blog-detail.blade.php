<div>
    <!-- Container -->
    <div class="mx-auto px-0 md:px-6 py-0 md:py-8 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 md:gap-8">

            <!-- Main Content - Full Width Mobile -->
            <div class="lg:col-span-8">
                <article>

                    <!-- Thumbnail - Full Width Responsive -->
                    <div class="overflow-hidden rounded-t-2xl">
                        @if ($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover" />
                        @else
                            <img src="{{ asset('images/no-foto.png') }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover" />
                        @endif
                    </div>

                    <!-- Article Content - Dengan Background di Desktop -->
                    <div
                        class="bg-transparent md:bg-white md:dark:bg-gray-800 md:rounded-b-lg md:shadow-md md:border md:border-t-0 md:border-gray-200 md:dark:border-gray-700">
                        <div class="md:p-6 lg:p-8">

                            <!-- Title -->
                            <h1
                                class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 text-gray-900 dark:text-white leading-tight">
                                {{ $post->title }}
                            </h1>

                            <!-- Meta Information -->
                            <div
                                class="flex flex-wrap gap-3 md:gap-4 text-sm text-gray-600 dark:text-gray-400 mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">

                                <!-- Author -->
                                <div class="flex items-center gap-2">
                                    <div
    class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
    style="background: linear-gradient(to right, #16a34a, #0d9488);">
    A
</div>

                                    <span class="font-semibold text-gray-900 dark:text-white">Admin</span>
                                </div>

                                <!-- Date -->
                                <div class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-medium text-gray-900 dark:text-white">
                                        {{ $post->post_date ? \Carbon\Carbon::parse($post->post_date)->format('d M Y') : 'N/A' }}
                                    </span>
                                </div>

                                <!-- Category -->
                                <div class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 flex-shrink-0"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <a href="{{ route('categories.show', $post->category->slug) }}"
                                        class="font-medium text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 hover:underline transition-colors">
                                        {{ $post->category->name }}
                                    </a>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="content-article">
                                {!! $post->content !!}
                            </div>

                            <!-- Tags (Tepat di bawah konten) -->
                            @if ($post->tags->count())
                                <div class="mt-6">
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tags:</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($post->tags as $tag)
                                            <span
                                                class="text-sm bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200 px-3 py-1 rounded-full">
                                                #{{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif



                            <!-- Share Section -->
                            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div
                                    class="bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/10 dark:to-teal-900/10 rounded-lg p-4">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                        <!-- Share Info -->
                                        <div class="flex items-center gap-3">
    <div
        class="w-10 h-10 rounded-full flex items-center justify-center text-white flex-shrink-0"
        style="background: linear-gradient(to right, #16a34a, #0d9488);">
        <i class="fas fa-share-alt text-sm"></i>
    </div>
    <div>
        <p class="text-xs text-gray-600 dark:text-gray-400">Bagikan artikel ini</p>
        <p class="font-semibold text-sm text-gray-900 dark:text-white">Share to Social Media</p>
    </div>
</div>


                                        <!-- Share Buttons -->
                                        <div class="flex items-center gap-2 sm:gap-3">
                                            <!-- WhatsApp -->
                                            <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                                                target="_blank"
                                                class="w-10 h-10 rounded-lg bg-white dark:bg-gray-700 shadow hover:shadow-md transform hover:scale-110 transition-all flex items-center justify-center border border-gray-200 dark:border-gray-600">
                                                <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                                            </a>

                                            <!-- Facebook -->
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                target="_blank"
                                                class="w-10 h-10 rounded-lg bg-white dark:bg-gray-700 shadow hover:shadow-md transform hover:scale-110 transition-all flex items-center justify-center border border-gray-200 dark:border-gray-600">
                                                <i class="fab fa-facebook-f text-blue-600 text-xl"></i>
                                            </a>

                                            <!-- Twitter/X -->
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                                target="_blank"
                                                class="w-10 h-10 rounded-lg bg-white dark:bg-gray-700 shadow hover:shadow-md transform hover:scale-110 transition-all flex items-center justify-center border border-gray-200 dark:border-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 1227"
                                                    fill="currentColor" class="w-5 h-5 text-black dark:text-white">
                                                    <path
                                                        d="M714.163 519.284 1160.89 0H1056.9L667.137 450.887 365.225 0H0l468.531 681.821L0 1226.37h104.005l409.383-474.164 320.53 474.164h365.225L714.137 519.284Zm-144.64 168.9-47.495-68.13L141.375 79.694h162.917l305.36 438.24 47.495 68.13 418.1 600.243H912.33L569.523 688.184Z" />
                                                </svg>
                                            </a>

                                            <!-- Copy Link -->
                                            <button onclick="copyToClipboard('{{ url()->current() }}')"
                                                class="w-10 h-10 rounded-lg bg-white dark:bg-gray-700 shadow hover:shadow-md transform hover:scale-110 transition-all flex items-center justify-center border border-gray-200 dark:border-gray-600">
                                                <i class="fas fa-link text-gray-700 dark:text-gray-300 text-base"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar (4 kolom) -->
            <div class="lg:col-span-4 md:px-0 mt-6 lg:mt-0">
                <div class="lg:sticky lg:top-6 space-y-4 pb-6 lg:pb-0">
                    <livewire:user.blog.sidebar.sidebar-blog />
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const notification = document.createElement('div');
                notification.className =
                    'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
                notification.innerHTML = '✓ Link berhasil disalin!';
                document.body.appendChild(notification);
                setTimeout(() => notification.remove(), 3000);
            });
        }
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</div>
