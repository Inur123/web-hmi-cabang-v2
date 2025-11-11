<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-teal-900">Dashboard Admin</h1>
        <p class="text-sm text-teal-600 mt-1">Selamat datang di panel admin HMI Cabang Ponorogo</p>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Views -->
        <div
            class="bg-gradient-to-br from-teal-500 to-teal-600 text-white rounded-xl shadow-lg p-6 transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-100 text-sm font-medium">Total Views</p>
                    <p class="text-3xl font-bold mt-1 counter" data-count="{{ $stats['total_views'] }}">0</p>
                </div>
                <div class="bg-teal-400 bg-opacity-30 p-3 rounded-full">
                    <i class="fas fa-eye text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Artikel -->
        <div
            class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6 transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Artikel</p>
                    <p class="text-3xl font-bold mt-1 counter" data-count="{{ $stats['posts'] }}">0</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 p-3 rounded-full">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div
            class="bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-xl shadow-lg p-6 transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium">Kategori</p>
                    <p class="text-3xl font-bold mt-1 counter" data-count="{{ $stats['categories'] }}">0</p>
                </div>
                <div class="bg-amber-400 bg-opacity-30 p-3 rounded-full">
                    <i class="fas fa-tags text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Kegiatan -->
        <div
            class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl shadow-lg p-6 transform transition hover:scale-105 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Kegiatan</p>
                    <p class="text-3xl font-bold mt-1 counter" data-count="{{ $stats['activities'] }}">0</p>
                </div>
                <div class="bg-emerald-400 bg-opacity-30 p-3 rounded-full">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Line Chart: Views per Bulan -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tren Views per Bulan</h3>
            <canvas id="viewsChart" height="100"></canvas>
        </div>

        <!-- Bar Chart: Top 5 Artikel -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 5 Artikel Terpopuler</h3>
            <canvas id="topPostsChart" height="100"></canvas>
        </div>
    </div>

    <!-- Recent Posts & Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Posts -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Artikel Terbaru</h2>
                <a href="{{ route('admin.posts') }}" class="text-teal-600 text-sm hover:underline">Lihat semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentPosts as $post)
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-teal-50 transition group">
                        <div class="flex-shrink-0">
                            @if ($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                    class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                            @else
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-800 truncate group-hover:text-teal-700 transition">
                                {{ $post->title }}
                            </p>
                            <div class="flex items-center gap-3 text-xs text-gray-500 mt-1">
                                <span class="text-teal-600">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $post->post_date ? \Carbon\Carbon::parse($post->post_date)->format('d M Y') : $post->created_at->format('d M Y') }}
                                </span>
                                <span class="flex items-center text-teal-700 font-medium">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span class="view-count" data-count="{{ $post->view ?? 0 }}">0</span>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-6">Belum ada artikel.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Kegiatan Terbaru</h2>
                <a href="{{ route('admin.activities') }}" class="text-teal-600 text-sm hover:underline">Lihat semua</a>
            </div>
            <div class="space-y-4">
                @forelse($recentActivities as $activity)
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-teal-50 transition group">
                        @if ($activity->image)
                            <img src="{{ asset('storage/' . $activity->image) }}"
                                class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                        @else
                            <div
                                class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-800 truncate group-hover:text-teal-700 transition">
                                {{ $activity->name }}
                            </p>
                            <p class="text-xs text-teal-600">
                                {{ $activity->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-6">Belum ada kegiatan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:navigated', () => {
        initializeDashboard();
    });

    // Juga jalankan saat halaman pertama kali load (untuk fallback)
    document.addEventListener('DOMContentLoaded', () => {
        if (!window.livewire) {
            initializeDashboard();
        }
    });

    function initializeDashboard() {
        // === Animasi Counter ===
        document.querySelectorAll('.counter, .view-count').forEach(el => {
            // Hentikan animasi sebelumnya jika ada
            el._animation && cancelAnimationFrame(el._animation);

            const target = +el.dataset.count;
            let count = 0;
            const inc = target / 60;

            const update = () => {
                count += inc;
                if (count < target) {
                    el.textContent = Math.ceil(count).toLocaleString('id-ID');
                    el._animation = requestAnimationFrame(update);
                } else {
                    el.textContent = target.toLocaleString('id-ID');
                    delete el._animation;
                }
            };
            update();
        });

        // === Chart: Views per Bulan ===
        const viewsCtx = document.getElementById('viewsChart');
        if (viewsCtx) {
            // Hancurkan chart lama jika ada
            if (viewsCtx.chart) viewsCtx.chart.destroy();

            viewsCtx.chart = new Chart(viewsCtx, {
                type: 'line',
                data: {
                    labels: @json($chartMonths),
                    datasets: [{
                        label: 'Total Views',
                        data: @json($chartViews),
                        borderColor: '#14b8a6',
                        backgroundColor: 'rgba(20, 184, 166, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#14b8a6',
                        pointRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 500
                            }
                        }
                    }
                }
            });
        }

        // === Chart: Top 5 Artikel ===
        const topPostsCtx = document.getElementById('topPostsChart');
        if (topPostsCtx) {
            if (topPostsCtx.chart) topPostsCtx.chart.destroy();

            topPostsCtx.chart = new Chart(topPostsCtx, {
                type: 'bar',
                data: {
                    labels: @json($topPostLabels),
                    datasets: [{
                        label: 'Jumlah Views',
                        data: @json($topPostViews),
                        backgroundColor: [
                            '#14b8a6', '#0d9488', '#0891b2', '#0369a1', '#1e40af'
                        ],
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: ctx => `${ctx.parsed.y} views`
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
</script>
