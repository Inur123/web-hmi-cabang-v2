{{-- resources/views/livewire/admin/pedoman/edit.blade.php --}}
<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                Edit Pedoman Administrasi
            </h1>
            <p class="text-sm text-gray-600 mt-1">
                Ubah data pedoman dan persyaratan yang terkait.
            </p>
        </div>

        <div class="flex gap-2">
            <button wire:click="back"
                class="px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </button>
        </div>
    </div>


    {{-- CARD FORM --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        {{-- TOP BAR --}}
        <div
            class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center">
                    <i class="fas fa-book text-gray-600"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Informasi Pedoman</p>
                    <p class="text-xs text-gray-500">Nama, status, deskripsi, dan slug</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                @if ($status === 'active')
                    <span class="text-xs px-3 py-1 rounded-full bg-teal-50 text-teal-700 border border-teal-200">
                        Active
                    </span>
                @else
                    <span class="text-xs px-3 py-1 rounded-full bg-gray-50 text-gray-700 border border-gray-200">
                        Inactive
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 space-y-6">

            {{-- GRID PEDOMAN --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- NAMA --}}
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pedoman</label>
                    <input type="text" wire:model.live="nama" maxlength="150"
                        placeholder="Contoh: Pedoman Administrasi Pengajuan SK"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-800
                               focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition
                               @error('nama') border-red-400 focus:ring-red-400 @enderror" />
                    @error('nama')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select wire:model.defer="status"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-800
                               focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition
                               @error('status') border-red-400 focus:ring-red-400 @enderror">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- SLUG PREVIEW --}}
                <div class="lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug (Otomatis)</label>
                    <div class="flex items-center gap-2">
                        <input type="text" value="{{ $slugPreview }}" readonly
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-700
                                   focus:ring-0 focus:border-gray-200 outline-none" />
                        <span class="text-xs px-3 py-2 rounded-xl border border-gray-200 bg-white text-gray-600">
                            Preview
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        Slug akan dibuat otomatis dari nama dan dijaga tetap unik.
                    </p>
                </div>

                {{-- DESKRIPSI --}}
                <div class="lg:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea wire:model.defer="deskripsi" rows="4" maxlength="2000"
                        placeholder="Tuliskan deskripsi singkat pedoman..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-800
                               focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition
                               @error('deskripsi') border-red-400 focus:ring-red-400 @enderror"></textarea>
                    @error('deskripsi')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            {{-- DIVIDER --}}
            <div class="border-t border-gray-100"></div>

            {{-- PERSYARATAN HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Persyaratan</h3>
                    <p class="text-sm text-gray-600">Tambahkan persyaratan yang harus dilampirkan.</p>
                </div>

                <button type="button" wire:click="addPersyaratan"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700 transition">
                    <i class="fas fa-plus"></i> Tambah Persyaratan
                </button>
            </div>

            @error('persyaratans')
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 text-sm">
                    <i class="fas fa-times-circle mr-2"></i>{{ $message }}
                </div>
            @enderror

            {{-- LIST PERSYARATAN --}}
            <div class="space-y-4">
                @foreach ($persyaratans as $i => $row)
                    <div class="rounded-2xl border border-gray-200 bg-gray-50/40 overflow-hidden">

                        {{-- head --}}
                        <div class="px-5 py-4 border-b border-gray-200 bg-white flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span
                                    class="w-8 h-8 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-sm text-gray-700">
                                    {{ $i + 1 }}
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">Persyaratan</p>
                                    <p class="text-xs text-gray-500">Isi nama, deskripsi, dan link download (jika ada)
                                    </p>
                                </div>
                            </div>

                            <button type="button" wire:click="removePersyaratan({{ $i }})"
                                class="text-red-600 hover:text-red-800 transition text-sm" title="Hapus persyaratan">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        {{-- body --}}
                        <div class="p-5 grid grid-cols-1 lg:grid-cols-3 gap-4">

                            {{-- NAMA --}}
                            <div class="lg:col-span-1">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Nama</label>
                                <input type="text" wire:model.defer="persyaratans.{{ $i }}.nama"
                                    maxlength="150" placeholder="Contoh: Foto KTP"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-800
                                           focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition
                                           @error('persyaratans.' . $i . '.nama') border-red-400 focus:ring-red-400 @enderror">
                                @error('persyaratans.' . $i . '.nama')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- DOWNLOAD --}}
                            <div class="lg:col-span-2">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Link Download
                                    (Opsional)</label>
                                <input type="text" wire:model.defer="persyaratans.{{ $i }}.download_url"
                                    maxlength="500" placeholder="https://contoh.com/file.pdf"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-800
                                           focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition
                                           @error('persyaratans.' . $i . '.download_url') border-red-400 focus:ring-red-400 @enderror">
                                @error('persyaratans.' . $i . '.download_url')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="lg:col-span-3">
                                <label class="block text-xs font-medium text-gray-600 mb-2">Deskripsi (Opsional)</label>
                                <textarea wire:model.defer="persyaratans.{{ $i }}.deskripsi" rows="3"
                                    placeholder="Catatan tambahan untuk persyaratan ini..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-800
                                           focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition
                                           @error('persyaratans.' . $i . '.deskripsi') border-red-400 focus:ring-red-400 @enderror"></textarea>
                                @error('persyaratans.' . $i . '.deskripsi')
                                    <small class="text-red-600">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- FOOTER BUTTONS --}}
            <div class="pt-2 flex flex-col sm:flex-row justify-end gap-2">
                <button wire:click="back"
                    class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700 transition">
                    Batal
                </button>

                <button wire:click="update" wire:loading.attr="disabled" wire:target="update"
                    class="px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-sm transition flex items-center justify-center gap-2">
                    <span wire:loading.remove wire:target="update">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </span>
                    <span wire:loading wire:target="update">
                        <i class="fas fa-spinner fa-spin"></i> Menyimpan...
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>
