<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Kegiatan</h1>
            <p class="text-sm text-gray-600 mt-1">Edit data kegiatan <strong>{{ $activity?->name }}</strong></p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <form wire:submit="update">
            <div class="space-y-6">
                <!-- Nama Kegiatan -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="name"
                        class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base">
                    @error('name')
                        <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="description"
                        class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base"
                        rows="4"></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <!-- Gambar -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar
                    </label>
                    <input type="file" wire:model="image" accept="image/*"
                        class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 border border-gray-300 rounded-lg cursor-pointer transition">
                    @error('image')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror

                    <!-- Preview -->
                    <div class="mt-4 flex gap-4 items-center">
                        @if ($image)
                            <div class="relative inline-block">
                                <img src="{{ $image->temporaryUrl() }}"
                                    class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                <span
                                    class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">Preview</span>
                            </div>
                        @elseif($activity?->image)
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $activity->image) }}"
                                    class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-lg border-2 border-blue-200 shadow-sm">
                                <span
                                    class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">Current</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg mt-4">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-info-circle mr-1"></i>
                    Dibuat pada {{ $activity?->created_at?->format('d F Y, H:i') }}
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                <button type="button" wire:click="back"
                    class="w-full sm:w-auto px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm sm:text-base cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm sm:text-base cursor-pointer">
                    <i class="fas fa-save mr-2"></i>Update Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>
