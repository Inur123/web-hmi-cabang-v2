<div class="fixed top-6 right-6 z-50 space-y-2">
    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 1000)"
            x-show="show"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-10"
            class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg mb-2 flex items-center justify-between min-w-[250px]"
        >
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                &times;
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 1000)"
            x-show="show"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-10"
            class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg mb-2 flex items-center justify-between min-w-[250px]"
        >
            <span>{{ session('error') }}</span>
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                &times;
            </button>
        </div>
    @endif
</div>
