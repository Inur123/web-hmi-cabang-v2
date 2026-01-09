<div class="space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Tambah Pedoman Administrasi</h1>
            <p class="text-sm text-gray-600 mt-1">Isi pedoman dan persyaratan</p>
        </div>
        <button wire:click="back"
            class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-200 text-gray-700 text-sm transition">
            Kembali
        </button>
    </div>

    <div class="bg-white rounded-xl shadow p-5 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" wire:model.live="nama"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm">
                @error('nama')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select wire:model="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                @error('status')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug (otomatis)</label>
                <input type="text" value="{{ $slugPreview }}" disabled
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-sm text-gray-600">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none text-sm"></textarea>
                @error('deskripsi')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="border-t pt-5">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-base font-semibold text-gray-800">Persyaratan</h3>
                <button type="button" wire:click="addPersyaratan"
                    class="px-3 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm transition">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </button>
            </div>

            <div class="space-y-3">
                @foreach ($persyaratans as $i => $row)
                    <div class="rounded-xl border border-gray-200 p-4 bg-gray-50">
                        <div class="flex items-start justify-between gap-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 flex-1">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama</label>
                                    <input type="text" wire:model="persyaratans.{{ $i }}.nama"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:ring-2 focus:ring-teal-500 focus:outline-none">
                                    @error("persyaratans.$i.nama")
                                        <small class="text-red-600">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Link Download</label>
                                    <input type="text" wire:model="persyaratans.{{ $i }}.download_url"
                                        placeholder="https://..."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:ring-2 focus:ring-teal-500 focus:outline-none">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Deskripsi</label>
                                    <textarea wire:model="persyaratans.{{ $i }}.deskripsi" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:ring-2 focus:ring-teal-500 focus:outline-none"></textarea>
                                </div>
                            </div>

                            <button type="button" wire:click="removePersyaratan({{ $i }})"
                                class="text-red-600 hover:text-red-800 mt-1" title="Hapus baris">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('persyaratans')
                <small class="text-red-600">{{ $message }}</small>
            @enderror
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <button wire:click="save"
                class="px-4 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm transition">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
        </div>
    </div>
</div>
