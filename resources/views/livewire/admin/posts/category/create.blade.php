<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Kategori Baru</h1>
            <p class="text-sm text-gray-600 mt-1">Tambahkan kategori post baru</p>
        </div>
        <button wire:click="back" class="text-gray-600 hover:text-gray-800 self-start sm:self-center">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </button>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <form wire:submit="save">
            <div class="space-y-6">
                <!-- Nama Kategori -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="name"
                        class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base"
                        placeholder="Contoh: Berita, Kegiatan">
                    @error('name')
                        <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview Card -->
                @if($name)
                    <div class="p-4 bg-teal-50 border-2 border-teal-200 rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">Preview:</p>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <h4 class="font-semibold text-gray-800 text-lg">{{ $name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar mr-1"></i>
                                Dibuat: {{ now()->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                <button type="button" wire:click="back"
                    class="w-full sm:w-auto px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm sm:text-base">
                    Batal
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm sm:text-base">
                    <i class="fas fa-save mr-2"></i>Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
