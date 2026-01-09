<div class="max-w-3xl mx-auto py-2 px-2 sm:px-4">

    <!-- Header -->
    <div class="mb-6 text-center">
        <div
            class="inline-block px-4 py-2 bg-gradient-to-r from-green-100 to-teal-100 dark:from-green-900/30 dark:to-teal-900/30 rounded-full mb-4">
            <span class="text-green-700 dark:text-green-300 font-semibold text-xs sm:text-sm">
                Layanan Permohonan
            </span>
        </div>

        <h1
            class="text-xl sm:text-xl md:text-xl font-bold leading-tight bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">
            Silakan isi form permohonan di bawah ini
        </h1>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div
            class="bg-teal-100 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg mb-6
                   dark:bg-teal-900/40 dark:border-teal-800 dark:text-teal-200">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Form Card -->
    <div
        class="bg-white dark:bg-gray-800 shadow rounded-lg
               p-4 sm:p-6 md:p-8
               border border-transparent dark:border-gray-700">

        <form wire:submit.prevent="submit" class="space-y-4">

            {{-- ================= NAMA ================= --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Nama Lengkap
                </label>

                <input type="text" wire:model.defer="nama_lengkap" maxlength="100"
                    placeholder="Masukkan nama lengkap"
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0 ring-offset-0
                           focus:border-teal-500 focus:ring-1 focus:ring-teal-500
                           transition
                           @error('nama_lengkap') border-red-500 focus:ring-red-500 @enderror">

                @error('nama_lengkap')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- ================= HP ================= --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Nomor HP
                </label>

                <input type="text" wire:model.defer="nomor_hp" maxlength="15" inputmode="numeric"
                    placeholder="Contoh: 08xxxxxxxxxx / +628xxxx" oninput="this.value=this.value.replace(/[^0-9+]/g,'')"
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0 ring-offset-0
                           focus:border-teal-500 focus:ring-1 focus:ring-teal-500
                           transition
                           @error('nomor_hp') border-red-500 focus:ring-red-500 @enderror">

                @error('nomor_hp')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- ================= ALAMAT ================= --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Alamat
                </label>

                <textarea wire:model.defer="alamat" rows="3" maxlength="255" placeholder="Masukkan alamat"
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0 ring-offset-0
                           focus:border-teal-500 focus:ring-1 focus:ring-teal-500
                           transition
                           @error('alamat') border-red-500 focus:ring-red-500 @enderror"></textarea>

                @error('alamat')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- ================= KEBUTUHAN ================= --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Kebutuhan
                </label>

                <select wire:model.defer="kebutuhan"
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0 ring-offset-0
                           focus:border-teal-500 focus:ring-1 focus:ring-teal-500
                           transition
                           @error('kebutuhan') border-red-500 focus:ring-red-500 @enderror">
                    <option value="">-- Pilih Kebutuhan --</option>
                    <option value="Rekomendasi">Rekomendasi</option>
                    <option value="Permohonan SK">Permohonan SK</option>
                    <option value="Surat Keterangan">Surat Keterangan</option>
                </select>

                @error('kebutuhan')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- ================= DESKRIPSI ================= --}}
            <div x-data="{ count: 0 }" x-init="count = $refs.textarea.value.length">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Deskripsi Permohonan
                </label>

                <textarea wire:model.defer="deskripsi" x-ref="textarea" @input="count = $refs.textarea.value.length" rows="5"
                    maxlength="1000" placeholder="Jelaskan permohonan Anda..."
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0 ring-offset-0
                           focus:border-teal-500 focus:ring-1 focus:ring-teal-500
                           transition
                           @error('deskripsi') border-red-500 focus:ring-red-500 @enderror"></textarea>

                <div class="flex justify-between mt-1">
                    <small class="text-gray-500 dark:text-gray-400">Minimal 10 karakter</small>
                    <small class="text-gray-500 dark:text-gray-400" x-text="count + '/1000'"></small>
                </div>

                @error('deskripsi')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- ================= PERSYARATAN ================= --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Persyaratan
                </label>

                <textarea wire:model.defer="persyaratan" rows="3" maxlength="1000"
                    placeholder="Tuliskan persyaratan yang dilampirkan"
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0 ring-offset-0
                           focus:border-teal-500 focus:ring-1 focus:ring-teal-500
                           transition
                           @error('persyaratan') border-red-500 focus:ring-red-500 @enderror"></textarea>

                @error('persyaratan')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            {{-- ================= RECAPTCHA ================= --}}
            {{-- ================= RECAPTCHA ================= --}}
            <div class="pt-1 flex justify-center md:justify-end">
                <div wire:ignore class="p-2 rounded-lg">
                    <div id="recaptcha-container" data-rendered="false"></div>
                </div>
            </div>

            @error('recaptchaToken')
                <small class="text-red-600 block mt-1 text-center md:text-right">
                    {{ $message }}
                </small>
            @enderror

            {{-- ================= SUBMIT ================= --}}
            <div class="pt-1">
                <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700
               text-white px-4 py-2 rounded-lg
               transition text-sm cursor-pointer
               flex justify-center items-center gap-2">

                    <span wire:loading.remove wire:target="submit">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Permohonan
                    </span>

                    <span wire:loading wire:target="submit">
                        <i class="fas fa-spinner fa-spin"></i> Mengirim...
                    </span>
                </button>
            </div>


        </form>
    </div>
</div>
