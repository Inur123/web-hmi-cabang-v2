<div x-show="sidebarOpen" @click.self="sidebarOpen = false"
    x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 bg-white/20 backdrop-blur-xl lg:hidden">

    <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 w-72 bg-white shadow-lg">

        <!-- Logo -->
        <div class="flex items-center justify-between p-4 h-[77px] border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-cabang-v2.webp') }}" alt="Logo HMI" class="h-9 w-auto rounded-full">
                <span class="text-l font-bold text-gray-800">HMI Cabang Ponorogo</span>
            </div>
            <button @click="sidebarOpen = false" class="text-gray-600 hover:text-gray-800 p-2">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>


        <!-- Menu Mobile -->
        <nav class="p-4 space-y-2 overflow-y-auto h-[calc(100vh-77px)]">

            <!-- Dashboard -->
            <button type="button" @click="Livewire.navigate('{{ route('admin.dashboard') }}'); sidebarOpen = false"
                class="w-full text-left flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-home text-lg w-6"></i>
                <span class="text-base font-medium">Dashboard</span>
            </button>

            <!-- Kegiatan -->
            <button type="button" @click="Livewire.navigate('{{ route('admin.activities') }}'); sidebarOpen = false"
                class="w-full text-left flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.activities') ? 'bg-teal-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-tasks text-lg w-6"></i>
                <span class="text-base font-medium">Kegiatan</span>
            </button>

            <!-- Manajemen Posts Dropdown -->
            <div x-data="{ open: {{ request()->routeIs('admin.posts') || request()->routeIs('admin.categories') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.posts') || request()->routeIs('admin.categories') ? 'bg-teal-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-newspaper text-lg w-6"></i>
                        <span class="text-base font-medium">Manajemen Posts</span>
                    </div>
                    <i :class="open ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-sm"></i>
                </button>

                <!-- Submenu -->
                <div x-show="open" x-transition class="ml-0 mt-2 space-y-1">
                    <!-- Posts -->
                    <button type="button" @click="Livewire.navigate('{{ route('admin.posts') }}'); sidebarOpen = false"
                        class="w-full flex items-center pl-14 pr-4 py-2.5 space-x-3 rounded-lg transition cursor-pointer {{ request()->routeIs('admin.posts') ? 'bg-teal-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-circle text-xs w-4"></i>
                        <span class="text-base">Posts</span>
                    </button>

                    <!-- Category -->
                    <button type="button"
                        @click="Livewire.navigate('{{ route('admin.categories') }}'); sidebarOpen = false"
                        class="w-full flex items-center pl-14 pr-4 py-2.5 space-x-3 rounded-lg transition cursor-pointer {{ request()->routeIs('admin.categories') ? 'bg-teal-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-circle text-xs w-4"></i>
                        <span class="text-base">Category</span>
                    </button>
                </div>
            </div>

        </nav>
    </div>
</div>
