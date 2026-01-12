<div class="space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Pedoman</h1>
            <p class="text-sm text-gray-600 mt-1">Informasi lengkap pedoman dan persyaratan</p>
        </div>
        <div class="flex gap-2">
            <button wire:click="edit('{{ $pedoman->id }}')"
                class="px-4 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-sm transition">
                <i class="fas fa-pen mr-2"></i>Edit
            </button>
            <button wire:click="back"
                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-200 text-gray-700 text-sm transition">
                Kembali
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="p-5 border-b border-gray-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-lg font-semibold text-gray-800">{{ $pedoman->nama }}</div>
                    <div class="text-sm text-gray-500">Slug: <span class="font-medium">{{ $pedoman->slug }}</span></div>
                </div>
                <span
                    class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $pedoman->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-700' }}">
                    {{ $pedoman->status }}
                </span>
            </div>

            @if ($pedoman->deskripsi)
                <div class="mt-4">
                    <p class="text-[11px] uppercase tracking-wide text-gray-500 mb-2">Deskripsi</p>
                    <div class="rounded-xl border border-gray-200 bg-white p-4 text-sm text-gray-800 ">
                        {{ $pedoman->deskripsi }}
                    </div>
                </div>
            @endif
        </div>

        <div class="p-5">
            <h3 class="text-base font-semibold text-gray-800 mb-3">Persyaratan</h3>

            @if ($pedoman->persyaratans->count())
                <div class="space-y-3">
                    @foreach ($pedoman->persyaratans as $ps)
                        <div class="rounded-xl border border-gray-200 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $ps->nama }}</div>
                                    @if ($ps->deskripsi)
                                        <div class="text-sm text-gray-600 mt-1 whitespace-pre-line">{{ $ps->deskripsi }}
                                        </div>
                                    @endif
                                </div>

                                @if ($ps->download_url)
                                    <a href="{{ $ps->download_url }}" target="_blank"
                                        class="px-3 py-2 rounded-lg bg-teal-600 hover:bg-teal-700 text-white text-xs transition">
                                        <i class="fas fa-download mr-2"></i>Download
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-sm text-gray-500">Belum ada persyaratan.</div>
            @endif
        </div>
    </div>
</div>
