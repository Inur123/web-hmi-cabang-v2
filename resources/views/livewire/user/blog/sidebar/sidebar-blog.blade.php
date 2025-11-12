<div class="space-y-4">

    <!-- Categories Card -->
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <h3 class="text-lg font-bold mb-3 text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fas fa-tags text-green-600 dark:text-green-400 text-base"></i>
            Categories
        </h3>
        <ul class="space-y-2">
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->slug) }}" wire:navigate
                        class="flex items-center text-sm text-gray-700 dark:text-gray-300 hover:text-green-600 dark:hover:text-green-400 font-medium transition-all duration-300 py-1.5 hover:pl-2 group">
                        <i
                            class="fas fa-angle-right text-xs mr-2 text-gray-400 group-hover:text-green-600 transition-colors"></i>
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Most Popular Posts Card -->
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <h3 class="text-lg font-bold mb-3 text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fas fa-fire text-teal-600 dark:text-teal-400 text-base"></i>
            Popular Posts
        </h3>

        <div class="space-y-3">
            @forelse ($popularPosts as $popularPost)
                <a href="{{ route('blog.show', $popularPost->slug) }}" wire:navigate
                    class="flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-300 group">

                    <!-- Thumbnail -->
                    <div
                        class="w-16 h-16 overflow-hidden rounded-md flex-shrink-0 ring-1 ring-gray-200 dark:ring-gray-600 group-hover:ring-green-500 dark:group-hover:ring-green-400 transition-all duration-300">
                        @if ($popularPost->thumbnail)
                            <img src="{{ asset('storage/' . $popularPost->thumbnail) }}" alt="{{ $popularPost->title }}"
                                class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                        @else
                            <img src="{{ asset('images/no-foto.png') }}" alt="{{ $popularPost->title }}"
                                class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                        @endif
                    </div>

                    <!-- Post Info -->
                    <div class="flex-1 min-w-0">
                        <h4
                            class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300 leading-snug mb-1">
                            {{ $popularPost->title }}
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
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
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <h3 class="text-lg font-bold mb-3 text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fas fa-tags text-green-600 dark:text-green-400 text-base"></i>
            Tags
        </h3>
        <div class="flex flex-wrap gap-2">
            @forelse ($tags as $tag)
                <span
                    class="text-sm bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200 px-3 py-1 rounded-full">
                    {{ $tag->name }}
                </span>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada tag</p>
            @endforelse
        </div>
    </div>

</div>
