<div :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="fixed inset-y-0 left-0 z-50 bg-white shadow-lg transition-all duration-300 hidden lg:block">

    <!-- Logo -->
    <div class="flex items-center justify-center p-4 h-[77px] border-b border-gray-200">
        <div class="flex items-center space-x-2" :class="!sidebarOpen && 'justify-center w-full'">
            <i class="fas fa-building text-2xl text-blue-600"></i>
            <span x-show="sidebarOpen" x-transition.opacity class="text-lg font-bold text-gray-800">
                Hmi Cabang Ponorogo
            </span>
        </div>
    </div>

    <!-- Menu -->
    <nav class="p-3 space-y-2 overflow-y-auto h-[calc(100vh-77px)]">

        <!-- Dashboard -->
        <div class="w-full flex items-center rounded-lg transition cursor-pointer bg-blue-600 text-white"
            :class="sidebarOpen ? 'px-4 py-3 space-x-3' : 'justify-center p-3'">
            <i class="fas fa-home text-lg"></i>
            <span x-show="sidebarOpen" x-transition.opacity class="text-base font-medium">Dashboard</span>
        </div>

        <!-- Kegiatan -->
        <div class="w-full flex items-center rounded-lg transition cursor-pointer text-gray-700 hover:bg-gray-100"
            :class="sidebarOpen ? 'px-4 py-3 space-x-3' : 'justify-center p-3'">
            <i class="fas fa-tasks text-lg"></i>
            <span x-show="sidebarOpen" x-transition.opacity class="text-base font-medium">Kegiatan</span>
        </div>

        <!-- Manajemen Posts -->
        <div x-data="{ open: false }">
            <button type="button" @click="sidebarOpen && (open = !open)"
                class="w-full flex items-center rounded-lg transition cursor-pointer text-gray-700 hover:bg-gray-100"
                :class="sidebarOpen ? 'px-4 py-3 justify-between' : 'justify-center p-3'">

                <div class="flex items-center" :class="sidebarOpen && 'space-x-3'">
                    <i class="fas fa-newspaper text-lg"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="text-base font-medium">Manajemen Posts</span>
                </div>

                <i x-show="sidebarOpen" class="fas text-sm" :class="open ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
            </button>

            <!-- Submenu -->
            <div x-show="open && sidebarOpen" x-transition class="ml-0 mt-2 space-y-1">
                <div
                    class="w-full flex items-center pl-14 pr-4 py-2.5 space-x-3 rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer">
                    <i class="fas fa-circle text-xs w-4"></i>
                    <span class="text-base">Posts</span>
                </div>
                <div
                    class="w-full flex items-center pl-14 pr-4 py-2.5 space-x-3 rounded-lg text-gray-600 hover:bg-gray-100 cursor-pointer">
                    <i class="fas fa-circle text-xs w-4"></i>
                    <span class="text-base">Category</span>
                </div>
            </div>
        </div>

    </nav>
</div>
