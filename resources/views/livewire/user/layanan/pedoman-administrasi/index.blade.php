<div class="min-h-screen
            bg-gradient-to-b from-gray-50 via-emerald-50/30 to-gray-50
            dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight
                               bg-gradient-to-r from-emerald-700 via-green-600 to-emerald-500
                               bg-clip-text text-transparent
                               dark:from-emerald-500 dark:via-green-400 dark:to-emerald-300">
                        Pedoman Administrasi
                    </h1>

                    <p class="mt-2 text-sm text-gray-600 dark:text-slate-300">
                        Klik card untuk melihat detail.
                        <span class="font-semibold text-emerald-800 dark:text-emerald-500">
                            (Dokumen & persyaratan)
                        </span>
                    </p>
                </div>

                <span class="inline-flex items-center gap-2 rounded-full
                             border border-emerald-200/70 dark:border-emerald-500/25
                             bg-emerald-50/70 dark:bg-emerald-900/15
                             px-3 py-1 text-xs font-semibold
                             text-emerald-800 dark:text-emerald-500 w-fit">
                    <i class="fas fa-book-open text-[11px]"></i>
                    Layanan
                </span>
            </div>
        </div>

        {{-- List --}}
        @if($items->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($items as $item)
                    <a href="{{ route('layanan.pedoman.detail', $item->slug) }}" wire:navigate
                       class="group block rounded-2xl
                              border border-gray-200/80 dark:border-white/10
                              bg-white/90 dark:bg-slate-900/50 backdrop-blur
                              shadow-sm hover:shadow-lg hover:-translate-y-[2px]
                              transition-all duration-200 overflow-hidden">

                        <div class="h-1.5 bg-gradient-to-r from-emerald-500/80 via-green-400/40 to-transparent"></div>

                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $item->nama }}
                                    </h3>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-slate-300 truncate">
                                        {{ $item->slug }}
                                    </p>
                                </div>

                                <span class="shrink-0 inline-flex items-center gap-1 rounded-full
                                             bg-emerald-50 dark:bg-emerald-900/20
                                             text-emerald-700 dark:text-emerald-200
                                             border border-emerald-200/60 dark:border-emerald-500/20
                                             px-3 py-1 text-xs font-semibold">
                                    <i class="fas fa-list-check text-[10px]"></i>
                                    {{ $item->persyaratans_count }}
                                </span>
                            </div>

                            <p class="mt-4 text-sm text-gray-600 dark:text-slate-200 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? 'Tidak ada deskripsi.'), 120) }}
                            </p>

                            <div class="mt-5 flex items-center justify-between">
                                <span class="text-xs text-gray-500 dark:text-slate-300">
                                    {{ $item->created_at?->format('d M Y') ?? '-' }}
                                </span>

                                <span class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 dark:text-emerald-200">
                                    Buka
                                    <i class="fas fa-arrow-right text-xs transition-transform duration-200 group-hover:translate-x-1"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white/90 dark:bg-slate-900/50 backdrop-blur
                        border border-gray-200/80 dark:border-white/10
                        rounded-2xl p-10 text-center">
                <i class="fas fa-inbox text-4xl text-gray-300 dark:text-slate-600 mb-3"></i>
                <p class="text-gray-700 dark:text-slate-200 font-semibold">Data pedoman belum tersedia</p>
                <p class="text-sm text-gray-500 dark:text-slate-300 mt-1">Belum ada pedoman yang aktif.</p>
            </div>
        @endif

    </div>
</div>
