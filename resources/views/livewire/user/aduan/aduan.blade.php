<div class="max-w-3xl mx-auto py-2 px-4">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Layanan Aduan</h1>
        <p class="text-sm text-gray-600 mt-1">Silakan isi form aduan di bawah ini</p>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="bg-teal-100 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white shadow rounded-lg p-6">
        <form wire:submit.prevent="submit" class="space-y-4">

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text"
                    wire:model.defer="nama_lengkap"
                    maxlength="100"
                    placeholder="Masukkan nama lengkap"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm
                    @error('nama_lengkap') border-red-500 @else border-gray-300 @enderror">

                @error('nama_lengkap')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                <input type="text"
                    wire:model.defer="nomor_hp"
                    inputmode="numeric"
                    maxlength="15"
                    placeholder="Contoh: 08xxxxxxxxxx / +628xxxx"
                    oninput="this.value=this.value.replace(/[^0-9+]/g,'')"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm
                    @error('nomor_hp') border-red-500 @else border-gray-300 @enderror">

                @error('nomor_hp')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea wire:model.defer="alamat"
                    rows="3"
                    maxlength="255"
                    placeholder="Masukkan alamat"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm
                    @error('alamat') border-red-500 @else border-gray-300 @enderror"></textarea>

                @error('alamat')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <!-- Isi Aduan -->
            <div x-data="{ count: 0 }" x-init="count = $refs.textarea.value.length">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Aduan</label>

                <textarea wire:model.defer="isi_aduan"
                    x-ref="textarea"
                    @input="count = $refs.textarea.value.length"
                    rows="5"
                    maxlength="1000"
                    placeholder="Tuliskan aduan Anda..."
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent focus:outline-none text-sm
                    @error('isi_aduan') border-red-500 @else border-gray-300 @enderror"></textarea>

                <div class="flex items-center justify-between mt-1">
                    @error('isi_aduan')
                        <small class="text-red-600">{{ $message }}</small>
                    @else
                        <small class="text-gray-500">Minimal 10 karakter</small>
                    @enderror

                    <small class="text-gray-500" x-text="count + '/1000'"></small>
                </div>
            </div>

            <!-- Button -->
            <div class="pt-4">
                <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="submit"
                    class="w-full bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition text-sm cursor-pointer flex justify-center items-center gap-2">

                    <span wire:loading.remove wire:target="submit">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Aduan
                    </span>

                    <span wire:loading wire:target="submit">
                        <i class="fas fa-spinner fa-spin"></i> Mengirim...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
