<div class="min-h-screen bg-gray-50/60 dark:bg-gray-900/40">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <button wire:click="goIndex"
            class="inline-flex items-center gap-2 text-sm font-semibold
           text-gray-700 dark:text-gray-200
           border border-gray-200 dark:border-gray-700
           bg-white/80 dark:bg-gray-800/60
           px-4 py-2 rounded-xl
           hover:border-teal-400 dark:hover:border-teal-500
           hover:text-teal-500 dark:hover:text-teal-300
           hover:bg-teal-60 dark:hover:bg-teal-900/30
           transition mb-6 cursor-pointer">
            <i class="fas fa-arrow-left text-xs"></i>
            Kembali
        </button>
        <div
            class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm overflow-hidden">
            <div class="h-2 bg-gradient-to-r from-teal-600/70 to-teal-500/10"></div>

            <div class="p-6">
                <p class="text-[11px] uppercase tracking-wide text-gray-500 dark:text-gray-300">Pedoman Administrasi</p>
                <h1 class="mt-1 text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $detail['nama'] ?? '-' }}
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    {{ $detail['slug'] ?? '-' }} • {{ $detail['created_at'] ?? '-' }}
                </p>

                <div class="mt-6">
                    <p class="text-[11px] uppercase tracking-wide text-gray-500 dark:text-gray-300 mb-2">Deskripsi</p>
                    <div
                        class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4 text-sm text-gray-800 dark:text-gray-100">
                        {{ $detail['deskripsi'] ?? '-' }}
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[11px] uppercase tracking-wide text-gray-500 dark:text-gray-300">
                            Persyaratan
                        </p>
                        <span class="text-xs font-semibold text-teal-700 dark:text-teal-200">
                            {{ count($detail['persyaratans'] ?? []) }} item
                        </span>
                    </div>

                    <div class="mt-3 space-y-3">
                        @forelse(($detail['persyaratans'] ?? []) as $ps)
                            <div
                                class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $ps['nama'] ?? '-' }}
                                        </p>
                                        @if (!empty($ps['deskripsi']))
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                                {{ $ps['deskripsi'] }}
                                            </p>
                                        @endif
                                    </div>

                                    @if (!empty($ps['download_url']))
                                        <a href="{{ $ps['download_url'] }}" target="_blank"
                                            class="shrink-0 inline-flex items-center gap-2 px-3 py-2 rounded-xl
                                                  bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold transition">
                                            <i class="fas fa-download text-xs"></i> Download
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div
                                class="rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-6 text-center">
                                <i class="fas fa-info-circle text-2xl text-gray-300 dark:text-gray-600 mb-2"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Belum ada persyaratan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
