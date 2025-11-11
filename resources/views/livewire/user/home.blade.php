<div>
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .snap-x {
            scroll-snap-type: x mandatory;
        }

        .snap-start {
            scroll-snap-align: start;
        }

        .snap-always {
            scroll-snap-stop: always;
        }
    </style>

    {{-- HERO SECTION + SLIDER (Alpine.js) --}}
    <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12 grid md:grid-cols-2 gap-8 sm:gap-12 items-center"
        data-aos="zoom-in" x-data="{
            images: [
                { src: '{{ asset('images/d-2.jpeg') }}', alt: 'HMI Members' },
                { src: '{{ asset('images/d-1.jpeg') }}', alt: 'HMI Activities' }
            ],
            current: 0,
            init() {
                setInterval(() => {
                    this.current = (this.current + 1) % this.images.length;
                }, 5000);
            }
        }">
        <div class="space-y-6 sm:space-y-8">
            <div>
                <div
                    class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 bg-gradient-to-r from-green-100 to-teal-100 dark:from-green-900/30 dark:to-teal-900/30 rounded-full mb-3 sm:mb-4">
                    <span class="text-green-700 dark:text-green-300 font-semibold text-xs sm:text-sm">Organisasi
                        Mahasiswa Islam</span>
                </div>
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">
                    HMI CABANG PONOROGO
                </h1>
            </div>
            <p class="text-gray-600 dark:text-gray-300 text-base sm:text-lg text-justify leading-relaxed">
                Himpunan Mahasiswa Islam (HMI) Cabang Ponorogo adalah salah satu cabang organisasi mahasiswa Islam
                terbesar di Indonesia, yang berada di wilayah Ponorogo. Sebagai bagian dari HMI, cabang ini memiliki
                peran penting dalam mewadahi aspirasi, pengembangan intelektual, dan pembinaan keislaman mahasiswa di
                daerah tersebut.
            </p>
            <div
                class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-xl border-l-4 border-green-600">
                <i class="fas fa-phone text-green-600 dark:text-green-400 text-xl sm:text-2xl flex-shrink-0"></i>
                <div>
                    <div class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Hubungi kami 085785864497
                    </div>
                    <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Untuk pertanyaan atau keluhan</div>
                </div>
            </div>
        </div>

        <!-- Hero Image Slider (Desktop Only) -->
        <div class="hidden md:block relative h-64 sm:h-80 md:h-96 lg:h-[500px] rounded-2xl" data-aos="fade-left">
            <div class="relative w-full h-full">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-teal-500/20 rounded-2xl blur-3xl">
                </div>
                <template x-for="(img, i) in images" :key="i">
                    <img :src="img.src" :alt="img.alt"
                        class="object-cover w-full h-full rounded-2xl shadow-2xl transition-opacity duration-1000 absolute inset-0 border-4 border-white dark:border-gray-800"
                        x-show="current === i" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                </template>
            </div>
        </div>
    </div>

    {{-- SAMBUTAN KETUA UMUM --}}
    <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12">
        <div class="text-center mb-8 sm:mb-12" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-2">Sambutan Ketua Umum</h2>
            <div
                class="w-20 sm:w-24 h-1 bg-gradient-to-r from-green-500 via-teal-600 to-emerald-600 mx-auto rounded-full">
            </div>
        </div>
        <div
            class="max-w-6xl mx-auto bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 shadow-2xl rounded-2xl sm:rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="relative flex-shrink-0 p-6 sm:p-8 lg:p-12 w-full lg:w-auto" data-aos="fade-right">
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-500 via-teal-600 to-emerald-600 rounded-full blur-2xl opacity-20 animate-pulse">
                        </div>
                        <div class="relative flex justify-center">
                            <img src="{{ asset('images/nanda-2.png') }}" alt="Ketua Umum HMI"
                                class="w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64 rounded-full border-4 sm:border-8 border-white dark:border-gray-700 shadow-2xl object-cover relative z-10" />
                            <div
                                class="absolute bottom-2 sm:bottom-4 right-2 sm:right-4 bg-gradient-to-r from-green-600 to-teal-600 text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-full shadow-lg text-xs sm:text-sm font-bold z-20">
                                Ketua Umum
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4 sm:mt-6 space-y-1 sm:space-y-2">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Nanda Dwi Yanuari</h3>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 font-medium">Periode 2025-2026
                        </p>
                        <div class="flex items-center justify-center gap-2 text-green-600 dark:text-green-400">
                            <i class="fas fa-map-marker-alt text-sm sm:text-base"></i>
                            <span class="text-xs sm:text-sm font-medium">HMI Cabang Ponorogo</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8 lg:p-12 lg:pl-8 flex-1 w-full" data-aos="fade-left">
                    <div class="mb-4 sm:mb-6">
                        <div
                            class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-full mb-3 sm:mb-4">
                            <i class="fas fa-quote-left text-green-600 dark:text-green-400 text-sm sm:text-base"></i>
                            <span
                                class="text-xs sm:text-sm font-bold text-green-700 dark:text-green-300">Sambutan</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            Assalamualaikum Warahmatullahi Wabarakatuh
                        </h2>
                    </div>
                    <div
                        class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed text-justify">
                        <p
                            class="first-letter:text-3xl sm:first-letter:text-5xl first-letter:font-bold first-letter:text-green-600 dark:first-letter:text-green-400 first-letter:mr-1 sm:first-letter:mr-2 first-letter:float-left">
                            Selamat datang di situs resmi HMI Cabang Ponorogo. Tujuan dari kehadiran website HMI Cabang
                            Ponorogo ini sebagai media informasi, wadah penyampaian aspirasi kader serta sarana dakwah.
                        </p>
                        <p>
                            HMI Cabang Ponorogo sesuai dengan tingkatan strukturalnya berada pada tingkatan Cabang yang
                            saat ini melingkupi kader HMI di 5 Wilayah, yaitu, <span
                                class="font-semibold text-green-600 dark:text-green-400">Kabupaten Ponorogo, Kabupaten
                                Magetan, Kabupaten Madiun, Kota Madiun, dan Kabupaten Ngawi</span>.
                        </p>
                        <p>
                            Berada pada tingkatan Cabang, HMI Cabang Ponorogo tetap menjunjung tinggi komitmen Keislaman
                            dan Komitmen Keindonesiaan yang di aktualisasikan dalam lingkup daerah dengan berdasarkan
                            prinsip Integratif sebagai bentuk manajemen kerja Organisasi.
                        </p>
                        <div
                            class="mt-4 sm:mt-6 p-4 sm:p-6 bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-xl sm:rounded-2xl border-l-4 border-green-600 dark:border-green-400">
                            <p class="text-gray-800 dark:text-gray-200 font-medium italic">
                                "Salam hangat dari saya <span class="font-bold text-green-700 dark:text-green-300">Nanda
                                    Dwi Yanuari</span> selaku Ketua Umum Himpunan Mahasiswa Islam Cabang Ponorogo
                                Periode 2025-2026."
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 mt-6 sm:mt-8">
                        <div
                            class="text-center p-3 sm:p-4 bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
                            <div class="text-xl sm:text-2xl font-bold text-green-600 dark:text-green-400">5</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">Wilayah</div>
                        </div>
                        <div
                            class="text-center p-3 sm:p-4 bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
                            <div class="text-xl sm:text-2xl font-bold text-teal-600 dark:text-teal-400">18</div>
                            <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">Komisariat</div>
                        </div>
                        <div
                            class="text-center p-3 sm:p-4 bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
                            <div class="text-xl sm:text-2xl font-bold text-emerald-600 dark:text-emerald-400">1000+
                            </div>
                            <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kader</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TENTANG KAMI --}}
    <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12">
        <div class="text-center mb-8 sm:mb-12" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-2">Tentang Kami</h2>
            <div
                class="w-20 sm:w-24 h-1 bg-gradient-to-r from-green-500 via-teal-600 to-emerald-600 mx-auto rounded-full">
            </div>
        </div>
        <div
            class="flex flex-col lg:flex-row items-center gap-8 sm:gap-12 bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden p-6 sm:p-8 lg:p-12">
            <div class="flex-shrink-0 w-full lg:w-auto" data-aos="fade-right">
                <div class="relative flex justify-center lg:justify-start">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-500 to-teal-600 rounded-3xl blur-3xl opacity-20 animate-pulse">
                    </div>
                    <img src="{{ asset('images/logo-hmi.png') }}" alt="HMI Logo"
                        class="w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64 lg:w-72 lg:h-72 relative z-10 object-contain" />
                </div>
            </div>
            <div class="flex-1 w-full" data-aos="fade-left">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-4 sm:mb-6">
                    HMI, Himpunan Mahasiswa Islam
                </h1>
                <p
                    class="text-sm sm:text-base text-gray-600 dark:text-gray-300 leading-relaxed mb-3 sm:mb-4 text-justify">
                    Himpunan Mahasiswa Islam (HMI) adalah organisasi mahasiswa yang dibentuk untuk menampung potensi dan
                    aspirasi mahasiswa di Indonesia. Didirikan pada <span
                        class="font-semibold text-green-600 dark:text-green-400">5 Februari 1947</span>, HMI memiliki
                    tujuan untuk menciptakan mahasiswa yang berkepribadian Muslim, berpengetahuan luas, serta
                    berkontribusi dalam membangun bangsa dan negara.
                </p>
                <p
                    class="text-sm sm:text-base text-gray-600 dark:text-gray-300 leading-relaxed mb-4 sm:mb-6 text-justify">
                    Organisasi ini berkomitmen untuk memperjuangkan nilai-nilai Islam sebagai pedoman universal dalam
                    kehidupan bermasyarakat, berbangsa, dan bernegara.
                </p>
                <a href=""
                    class="inline-flex items-center gap-2 px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white text-sm sm:text-base font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    Selengkapnya
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- KEGIATAN CAROUSEL (Alpine.js) --}}
    <div class="container mx-auto px-4 sm:px-6 py-8 sm:py-12" x-data="activitiesCarousel({{ $activities->toJson() }})">

        <!-- Header -->
        <div class="text-center mb-8 sm:mb-12" data-aos="fade-up">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Kegiatan</h2>
                <div class="hidden lg:flex gap-2">
                    <button @click="prev()"
                        class="p-2 rounded-full bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-600 dark:hover:text-green-400 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="index <= 0">
                        <i class="fas fa-chevron-left text-lg"></i>
                    </button>
                    <button @click="next()"
                        class="p-2 rounded-full bg-white dark:bg-gray-800 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-600 dark:hover:text-green-400 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="index >= items.length - 1">
                        <i class="fas fa-chevron-right text-lg"></i>
                    </button>
                </div>
            </div>
            <div
                class="w-20 sm:w-24 h-1 bg-gradient-to-r from-green-500 via-teal-600 to-emerald-600 mx-auto rounded-full">
            </div>
        </div>

        <!-- Jika ADA data -->
        <template x-if="items.length > 0">
            <div class="relative">
                <div id="activities-container"
                    class="overflow-x-auto scrollbar-hide scroll-smooth snap-x snap-mandatory" x-ref="container"
                    @scroll.debounce.150ms="updateIndex()">
                    <div class="flex gap-4 sm:gap-6 pb-4 px-2">
                        <template x-for="(item, i) in items" :key="i">
                            <article
                                class="group bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-500 border border-gray-200 dark:border-gray-700 flex-shrink-0 w-72 sm:w-80 snap-start snap-always"
                                data-aos="zoom-in" :data-aos-delay="i * 100">

                                <!-- BAGIAN GAMBAR -->
                                <div
                                    class="relative h-56 sm:h-64 overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">

                                    <!-- Jika ADA gambar -->
                                    <template x-if="item.image">
                                        <img :src="`/storage/${item.image}`" alt="Activity Image"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </template>

                                    <!-- Jika TIDAK ADA gambar -->
                                    <template x-if="!item.image">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-image text-5xl text-gray-400 dark:text-gray-600"></i>
                                        </div>
                                    </template>

                                    <!-- Label -->
                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="inline-block px-3 py-1 bg-gradient-to-r from-green-600 to-teal-600 text-white text-xs font-bold rounded-full shadow-lg">
                                            Kegiatan
                                        </span>
                                    </div>
                                </div>

                                <!-- KONTEN TEKS -->
                                <div class="p-4 sm:p-6">
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300"
                                        x-text="item.name"></h3>
                                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300 line-clamp-3 leading-relaxed"
                                        x-text="item.description"></p>
                                </div>

                                <!-- GARIS HIJAU -->
                                <div
                                    class="h-1 bg-gradient-to-r from-green-500 via-teal-600 to-emerald-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                                </div>
                            </article>
                        </template>
                    </div>
                </div>

                <!-- Indikator (mobile) -->
                <div class="flex justify-center gap-2 mt-6 lg:hidden">
                    <template x-for="(item, i) in items" :key="i">
                        <div class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600 transition-all duration-300"
                            :class="{ 'bg-green-600 dark:bg-green-400 w-8': index === i, 'w-2': index !== i }"></div>
                    </template>
                </div>
            </div>
        </template>

        <!-- Jika TIDAK ADA data -->
        <template x-if="items.length === 0">
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <i class="fas fa-clipboard-list text-7xl text-gray-400 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Belum Ada Kegiatan</h3>
                <p class="text-gray-500 dark:text-gray-400 text-base">Kegiatan akan segera ditambahkan</p>
            </div>
        </template>
    </div>


    {{-- ARTIKEL TERBARU (Font Awesome Icons) --}}
    <div class="container mx-auto px-4 sm:px-6 py-12 sm:py-16
            bg-gradient-to-br from-gray-50 to-gray-100
            dark:from-gray-900 dark:to-gray-800
            text-gray-900 dark:text-white
            rounded-2xl transition-all duration-500"
     x-data="latestPosts({{ $posts->toJson() }})"
     x-init="init(); watchTheme()">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 sm:mb-12 gap-4" data-aos="fade-up">
        <div class="text-center md:text-left">
            <h2 class="text-3xl sm:text-4xl font-bold mb-2 text-gray-900 dark:text-white">
                Artikel Terbaru
            </h2>
            <p class="text-sm sm:text-base opacity-80 text-gray-600 dark:text-gray-300">
                Berita dan artikel terkini dari HMI Cabang Ponorogo
            </p>
        </div>
        <a href="{{ route('blog') }}" wire:navigate
           class="inline-flex items-center px-5 py-2.5
                  bg-gradient-to-r from-green-500 to-teal-500
                  hover:from-green-600 hover:to-teal-600
                  text-white text-sm sm:text-base font-semibold
                  rounded-full shadow-lg
                  transform hover:scale-105
                  transition-all duration-300">
            Lihat Semua
            <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Jika ADA data -->
    <template x-if="posts.length > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <template x-for="(post, i) in posts" :key="i">
                <article class="group bg-white dark:bg-gray-800
                                rounded-2xl overflow-hidden
                                shadow-lg hover:shadow-2xl
                                transition-all duration-500
                                border border-gray-200 dark:border-gray-700"
                         data-aos="zoom-in" :data-aos-delay="i * 100">
                    <a :href="`/blog/${post.slug}`" wire:navigate class="block">
                        <!-- Thumbnail -->
                        <div class="relative h-48 sm:h-56 overflow-hidden bg-gray-100 dark:bg-gray-700">
                            <template x-if="post.thumbnail">
                                <img :src="`/storage/${post.thumbnail}`"
                                     class="w-full h-full object-cover
                                            group-hover:scale-105
                                            transition-transform duration-500">
                            </template>
                            <template x-if="!post.thumbnail">
                                <div class="w-full h-full flex items-center justify-center
                                            bg-gradient-to-br from-teal-400 to-green-600
                                            dark:from-teal-600 dark:to-green-700">
                                    <i class="fas fa-newspaper text-6xl text-white/80"></i>
                                </div>
                            </template>
                        </div>

                        <!-- Meta: Avatar + Tanggal -->
                        <div class="flex items-center gap-3 px-4 pt-4 pb-2">
                            <div class="w-8 h-8 rounded-full
                                        bg-gradient-to-r from-green-600 to-teal-600
                                        flex items-center justify-center
                                        text-white font-bold text-xs">
                                <span x-text="post.title.charAt(0).toUpperCase()"></span>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                    Admin
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400
                                            flex items-center gap-1">
                                    <i class="far fa-calendar-alt text-xs"></i>
                                    <span x-text="formatDate(post.post_date)"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="px-4 pb-4">
                            <h3 class="text-lg sm:text-xl font-bold
                                       text-gray-900 dark:text-white
                                       mb-2 line-clamp-2"
                                x-text="post.title"></h3>
                            <p class="text-sm sm:text-base
                                     text-gray-600 dark:text-gray-300
                                     line-clamp-3 mb-3"
                               x-text="stripHtml(post.content).substring(0, 120) + '...'"></p>
                            <div class="flex items-center
                                        text-green-600 dark:text-green-400
                                        text-sm font-semibold
                                        group-hover:gap-2
                                        transition-all duration-300">
                                <span>Baca Selengkapnya</span>
                                <i class="fas fa-arrow-right
                                          transform group-hover:translate-x-2
                                          transition-transform duration-300"></i>
                            </div>
                        </div>
                    </a>
                </article>
            </template>
        </div>
    </template>

    <!-- Jika KOSONG -->
    <template x-if="posts.length === 0">
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <i class="fas fa-clipboard-list text-7xl text-gray-400 dark:text-gray-600 mb-6"></i>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-2">
                Belum Ada Artikel
            </h3>
            <p class="text-gray-500 dark:text-gray-400 text-base">
                Artikel akan segera ditambahkan
            </p>
        </div>
    </template>
</div>


    {{-- Alpine.js Logic --}}
    <script>
        function activitiesCarousel(itemsFromServer) {
            return {
                items: itemsFromServer ?? [],
                index: 0,
                prev() {
                    if (this.index > 0) this.scrollTo(this.index - 1);
                },
                next() {
                    if (this.index < this.items.length - 1) this.scrollTo(this.index + 1);
                },
                scrollTo(i) {
                    const container = this.$refs.container;
                    const card = container.querySelectorAll('article')[i];
                    const rect = card.getBoundingClientRect();
                    const containerRect = container.getBoundingClientRect();
                    const scrollLeft =
                        card.offsetLeft - container.offsetLeft - (containerRect.width / 2) + (rect.width / 2);
                    container.scrollTo({
                        left: scrollLeft,
                        behavior: 'smooth'
                    });
                    this.index = i;
                },
                updateIndex() {
                    const container = this.$refs.container;
                    const center = container.scrollLeft + container.offsetWidth / 2;
                    let closest = 0,
                        dist = Infinity;
                    container.querySelectorAll('article').forEach((c, i) => {
                        const cCenter = c.offsetLeft + c.offsetWidth / 2;
                        const d = Math.abs(center - cCenter);
                        if (d < dist) {
                            dist = d;
                            closest = i;
                        }
                    });
                    this.index = closest;
                }
            };
        }

        function latestPosts(postsFromServer = []) {
            return {
                posts: postsFromServer,
                init() {
                    // bisa tambahkan efek load di sini nanti
                },
                formatDate(dateStr) {
                    if (!dateStr) return '';
                    const d = new Date(dateStr);
                    return d.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });
                },
                stripHtml(html) {
                    const div = document.createElement('div');
                    div.innerHTML = html;
                    return div.textContent || div.innerText || '';
                }
            };
        }
    </script>
</div>
