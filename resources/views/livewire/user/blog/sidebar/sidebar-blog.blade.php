<div> {{-- Root wrapper --}}
    <!-- Categories Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fas fa-tags text-green-600 dark:text-green-400"></i>
            Categories
        </h2>
        <ul class="space-y-3">
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->slug) }}"
                       wire:navigate
                       class="block cursor-pointer text-gray-600 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-colors duration-300 hover:translate-x-1">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Most Popular Posts Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 mt-6 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fas fa-fire text-teal-600 dark:text-teal-400"></i>
            Most Popular Post
        </h2>
        <div class="space-y-4">
            @forelse ($popularPosts as $popularPost)
                <a href="{{ route('blog.show', $popularPost->slug) }}"
                   wire:navigate
                   class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-300 group">
                    <div class="w-16 h-16 overflow-hidden rounded-lg flex-shrink-0 ring-2 ring-gray-200 dark:ring-gray-600 group-hover:ring-green-500 dark:group-hover:ring-green-400 transition-all duration-300">
                        @if ($popularPost->thumbnail)
                            <img src="{{ asset('storage/' . $popularPost->thumbnail) }}"
                                 alt="{{ $popularPost->title }}"
                                 class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-gray-900 dark:text-white line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                            {{ $popularPost->title }}
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                            <i class="far fa-calendar-alt text-xs"></i>
                            {{ \Carbon\Carbon::parse($popularPost->post_date)->format('d M Y') }}
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                    Belum ada posting populer
                </p>
            @endforelse
        </div>
    </div>
</div>
