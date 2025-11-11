<div>
    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                Edit Post
            </h1>
            <p class="text-sm text-gray-600 mt-1">
                Perbarui informasi post
            </p>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 lg:p-8">
        <form wire:submit.prevent="update">
            <!-- Grid Layout for Form Fields -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">

                <!-- Judul Post -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Post <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="title"
                        class="w-full px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base transition"
                        placeholder="Masukkan judul post...">
                    @error('title')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Post -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" wire:model="post_date"
                        class="w-full px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base transition">
                    @error('post_date')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="category_id"
                        class="w-full px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base transition bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($allCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="status"
                        class="w-full px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base transition bg-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags - Full Width -->
                <div class="w-full lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tags <span class="text-gray-500 text-xs">(pisahkan dengan koma)</span>
                    </label>
                    <input type="text" wire:model="tagsString" placeholder="Contoh: Berita, Kegiatan, Tutorial"
                        class="w-full px-3 sm:px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm sm:text-base transition">
                    @error('tags')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten Post with TinyMCE - Full Width -->
                <div class="w-full lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konten <span class="text-red-500">*</span>
                    </label>
                    <div wire:ignore x-data="tinyMCEComponent(@entangle('content'))" x-init="initEditor('tinymce-editor-{{ $postId }}')">
                        <textarea id="tinymce-editor-{{ $postId }}" class="w-full"></textarea>
                    </div>
                    @error('content')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div class="w-full lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Thumbnail <span class="text-gray-500 text-xs">(kosongkan jika tidak ingin mengubah)</span>
                    </label>
                    <input type="file" wire:model="thumbnailTemp" accept="image/*"
                        class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 border border-gray-300 rounded-lg cursor-pointer transition">
                    @error('thumbnailTemp')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror

                    <!-- Thumbnail Preview -->
                    <div class="mt-4 flex gap-4 flex-wrap">
                        @if ($thumbnailTemp)
                            <div>
                                <p class="text-xs text-gray-600 mb-2 font-medium">Preview Baru:</p>
                                <div class="relative inline-block">
                                    <img src="{{ $thumbnailTemp->temporaryUrl() }}"
                                        class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-lg border-2 border-green-300 shadow-sm">
                                    <span
                                        class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">New</span>
                                </div>
                            </div>
                        @endif

                        @if ($thumbnail)
                            <div>
                                <p class="text-xs text-gray-600 mb-2 font-medium">Thumbnail Saat Ini:</p>
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $thumbnail) }}"
                                        class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    <span
                                        class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">Current</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Existing Gallery - Full Width -->
                @if (count($galleries) > 0)
                    <div class="w-full lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Gallery Existing
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                            @foreach ($galleries as $index => $galleryPath)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $galleryPath) }}"
                                        class="w-full h-28 sm:h-32 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    <button type="button" wire:click="removeGalleryExisting({{ $index }})"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- New Gallery - Full Width -->
                <div class="w-full lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Tambah Gallery Baru <span class="text-gray-500 text-xs">(multiple images)</span>
                    </label>

                    <div class="space-y-3">
                        @foreach ($galleryInputs as $index => $gallery)
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <!-- Input File -->
                                <div class="flex-1 w-full sm:w-auto">
                                    <input type="file" wire:model="galleryInputs.{{ $index }}"
                                        accept="image/*"
                                        class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-white file:text-teal-700 hover:file:bg-teal-50 border border-gray-300 rounded-lg cursor-pointer transition">
                                </div>

                                <!-- Preview Image -->
                                @if ($gallery)
                                    <div class="flex-shrink-0">
                                        <img src="{{ $gallery->temporaryUrl() }}"
                                            class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-lg border-2 border-teal-200 shadow-sm">
                                    </div>
                                @endif

                                <!-- Remove Button -->
                                <button type="button" wire:click="removeGalleryInput({{ $index }})"
                                    class="flex-shrink-0 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-medium inline-flex items-center justify-center w-full sm:w-auto">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Hapus
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Gallery Button -->
                    <button type="button" wire:click="addGalleryInput"
                        class="mt-3 px-4 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm font-medium inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Gambar Baru
                    </button>

                    @error('galleryInputs.*')
                        <p class="text-red-500 text-xs sm:text-sm mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <!-- End Grid Layout -->

            <!-- Action Buttons - Outside Grid -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" wire:click="back"
                    class="w-full sm:w-auto px-6 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-sm sm:text-base font-medium text-gray-700 inline-flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm sm:text-base font-medium inline-flex items-center justify-center shadow-sm">
                    <i class="fas fa-save mr-2"></i>
                    Update Post
                </button>
            </div>

        </form>
    </div>
</div>
