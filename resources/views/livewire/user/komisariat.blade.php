<div class="min-h-screen w-full bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-950">

    <div class="w-full px-4 sm:px-8 lg:px-16 py-10 sm:py-14">

        {{-- HEADER --}}
        <div class="max-w-4xl mx-auto text-center mb-14">
            <div
                class="inline-block px-4 py-2 bg-gradient-to-r from-green-100 to-teal-100 dark:from-green-900/30 dark:to-teal-900/30 rounded-full mb-4">
                <span class="text-green-700 dark:text-green-300 font-semibold text-xs sm:text-sm">
                    Komisariat HMI Se-Cabang Ponorogo
                </span>
            </div>

            <h1
                class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">
                Komisariat
            </h1>

            <p class="mt-4 text-gray-600 dark:text-gray-300 text-sm sm:text-base leading-relaxed">
                Klik logo atau nama komisariat untuk melihat informasi lebih lanjut.
            </p>

            <div class="w-24 h-1 mx-auto mt-6 rounded-full"
                style="background: linear-gradient(to right, #16a34a, #0d9488);">
            </div>
        </div>


        {{-- LOGO GRID (Brand Showcase) --}}
        <div class="max-w-6xl mx-auto">

            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-8 sm:gap-10 place-items-center">

                {{-- 1 Syariah --}}
                <a href="#"
                    class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1">

                    <div
                        class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full bg-white dark:bg-gray-800 shadow-md border border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden group-hover:shadow-xl group-hover:border-green-500 transition-all duration-300">
                        <img src="{{ asset('images/komisariat/kom-syariah.webp') }}" alt="Syariah"
                            class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-300" />
                    </div>

                    <p
                        class="mt-4 text-sm sm:text-base font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                        Komisariat Syariah
                    </p>
                </a>


                {{-- 2 Tarbiyah --}}
                <a href="#"
                    class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1">

                    <div
                        class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full bg-white dark:bg-gray-800 shadow-md border border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden group-hover:shadow-xl group-hover:border-green-500 transition-all duration-300">
                        <img src="{{ asset('images/komisariat/kom-tarbiyah.webp') }}" alt="Tarbiyah"
                            class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-300" />
                    </div>

                    <p
                        class="mt-4 text-sm sm:text-base font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                        Komisariat Tarbiyah
                    </p>
                </a>


                {{-- 3 Fakultas Hukum --}}
                <a href="#"
                    class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1">

                    <div
                        class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full bg-white dark:bg-gray-800 shadow-md border border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden group-hover:shadow-xl group-hover:border-green-500 transition-all duration-300">
                        <img src="{{ asset('images/komisariat/kom-hukum.webp') }}" alt="Hukum"
                            class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-300" />
                    </div>

                    <p
                        class="mt-4 text-sm sm:text-base font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                        Komisariat Hukum
                    </p>
                </a>


                {{-- 4 FITRAH --}}
                <a href="#"
                    class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1">

                    <div
                        class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full bg-white dark:bg-gray-800 shadow-md border border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden group-hover:shadow-xl group-hover:border-green-500 transition-all duration-300">
                        <img src="{{ asset('images/komisariat/kom-fitrah.webp') }}" alt="FITRAH"
                            class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-300" />
                    </div>

                    <p
                        class="mt-4 text-sm sm:text-base font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                        Komisariat FITRAH
                    </p>
                </a>
                {{-- 5 Ronggo --}}
                <a href="#"
                    class="group flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1">

                    <div
                        class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full bg-white dark:bg-gray-800 shadow-md border border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden group-hover:shadow-xl group-hover:border-green-500 transition-all duration-300">
                        <img src="{{ asset('images/logo-hmi.webp') }}" alt="Ronggo"
                            class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-300" />
                    </div>

                    <p
                        class="mt-4 text-sm sm:text-base font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300">
                        Ronggo Djumeno
                    </p>
                </a>

            </div>
        </div>

    </div>
</div>
