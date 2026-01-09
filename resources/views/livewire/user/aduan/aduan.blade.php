<div class="max-w-3xl mx-auto py-2 px-2 sm:px-4">

    <!-- Header -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100">
            Layanan Aduan
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
            Silakan isi form aduan di bawah ini
        </p>
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

            <!-- Nama Lengkap -->
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
                           outline-none ring-0
                           focus:border-teal-500
                           focus:ring-1 focus:ring-teal-500
                           focus:ring-offset-0
                           transition
                           @error('nama_lengkap') border-red-500 focus:ring-red-500 @enderror">

                @error('nama_lengkap')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>


            <!-- Nomor HP -->
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
                           outline-none ring-0
                           focus:border-teal-500
                           focus:ring-1 focus:ring-teal-500
                           focus:ring-offset-0
                           transition
                           @error('nomor_hp') border-red-500 focus:ring-red-500 @enderror">

                @error('nomor_hp')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <!-- Alamat -->
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
                           outline-none ring-0
                           focus:border-teal-500
                           focus:ring-1 focus:ring-teal-500
                           focus:ring-offset-0
                           transition
                           @error('alamat') border-red-500 focus:ring-red-500 @enderror"></textarea>

                @error('alamat')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

            <!-- Isi Aduan -->
            <div x-data="{ count: 0 }" x-init="count = $refs.textarea.value.length">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Isi Aduan
                </label>

                <textarea wire:model.defer="isi_aduan" x-ref="textarea" @input="count = $refs.textarea.value.length" rows="5"
                    maxlength="1000" placeholder="Tuliskan aduan Anda..."
                    class="w-full px-4 py-2 rounded-lg text-sm
                           bg-white dark:bg-gray-900
                           text-gray-800 dark:text-gray-100
                           placeholder-gray-400 dark:placeholder-gray-500
                           border border-gray-300 dark:border-gray-700
                           outline-none ring-0
                           focus:border-teal-500
                           focus:ring-1 focus:ring-teal-500
                           focus:ring-offset-0
                           transition
                           @error('isi_aduan') border-red-500 focus:ring-red-500 @enderror"></textarea>

                <div class="flex justify-between mt-1">
                    <small class="text-gray-500 dark:text-gray-400">
                        Minimal 10 karakter
                    </small>
                    <small class="text-gray-500 dark:text-gray-400" x-text="count + '/1000'"></small>
                </div>
            </div>
            <div class="pt-4 flex flex-col md:flex-row md:justify-start">
                <div class="flex justify-center md:justify-end">
                    <div wire:ignore class="p-2 rounded-lg">
                        <div id="recaptcha-container" data-rendered="false"></div>
                    </div>
                </div>
            </div>

            @error('recaptchaToken')
                <small class="text-red-600 block mt-2 text-center md:text-right">
                    {{ $message }}
                </small>
            @enderror
            <div class="pt-4">
                <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700
                           text-white px-4 py-2 rounded-lg
                           transition text-sm cursor-pointer
                           flex justify-center items-center gap-2">

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
