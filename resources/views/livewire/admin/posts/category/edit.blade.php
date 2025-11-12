<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Kategori</h1>
            <p class="text-sm text-gray-600 mt-1">Edit data kategori {{ $category?->name }}</p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <form wire:submit="update">
            <div class="space-y-6">
                <!-- Nama Kategori -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="name"
                        class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base">
                    @error('name')
                        <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info -->
                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-1"></i>
                        Dibuat oleh <strong>{{ $category?->user?->name }}</strong> pada
                        {{ $category?->created_at?->format('d F Y, H:i') }}
                    </p>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                <button type="button" wire:click="back"
                    class="w-full sm:w-auto px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm sm:text-base cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm sm:text-base cursor-pointer">
                    <i class="fas fa-save mr-2"></i>Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
