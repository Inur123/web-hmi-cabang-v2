<footer class="relative text-gray-100 overflow-hidden">
    <!-- Gradient Background (Light Mode) -->
    <div class="absolute inset-0 -z-10"
        style="background: linear-gradient(to bottom right, #111827, #1f2937, #111827); background-size: 100% 100%;">
    </div>

    <!-- Gradient Background (Dark Mode) -->
    <div class="absolute inset-0 -z-10 hidden dark:block"
        style="background: linear-gradient(to bottom right, #000000, #111827, #000000); background-size: 100% 100%;">
    </div>

    <!-- Background Pattern (SVG) -->
    <div class="absolute inset-0 -z-10 opacity-5 pointer-events-none">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
                    background-size: 60px 60px; background-repeat: repeat;">
        </div>
    </div>

    <!-- Main Content -->
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 pt-16 pb-6 relative z-10">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 mb-12">
            <!-- Brand Section -->
            <div class="lg:col-span-5">
                <div class="flex items-center mb-6">
                    <div class="relative">
                        <div class="absolute inset-0 bg-green-500 blur-xl opacity-30 rounded-full"></div>
                        <img src="{{ asset('images/logo-web.png') }}" alt="Logo HMI"
                            class="w-16 h-16 sm:w-20 sm:h-20 relative z-10">
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl sm:text-3xl font-bold bg-clip-text text-transparent"
                            style="
       background-image: linear-gradient(to right, #16a34a, #0d9488);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
   ">
                            HMI Cabang
                        </p>
                        <p class="text-xl sm:text-2xl font-bold text-white">Ponorogo</p>
                    </div>
                </div>

                <p class="text-sm sm:text-base text-gray-300 leading-relaxed mb-6 max-w-md">
                    Himpunan Mahasiswa Islam (HMI) adalah organisasi mahasiswa yang bertujuan menciptakan generasi
                    berilmu, berintegritas, dan berkontribusi untuk masyarakat, bangsa, dan negara.
                </p>

                <!-- Social Media -->
                <div>
                    <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Follow Us</p>
                    <div class="flex gap-3">
                        <!-- Facebook -->
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-green-500/50"
                            style="background: #1f2937; transition: background 0.3s;"
                            onmouseover="this.style.background='linear-gradient(to right, #16a34a, #0d9488)'"
                            onmouseout="this.style.background='#1f2937'">
                            <i class="fab fa-facebook-f text-gray-300 group-hover:text-white"></i>
                        </a>

                        <!-- Instagram -->
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-pink-500/50"
                            style="background: #1f2937;"
                            onmouseover="this.style.background='linear-gradient(to right, #ec4899, #a855f7)'"
                            onmouseout="this.style.background='#1f2937'">
                            <i class="fab fa-instagram text-gray-300 group-hover:text-white"></i>
                        </a>

                        <!-- X (Twitter) -->
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-gray-600/50"
                            style="background: #1f2937;"
                            onmouseover="this.style.background='linear-gradient(to right, #374151, #000000)'"
                            onmouseout="this.style.background='#1f2937'">
                            <i class="fa-brands fa-x-twitter text-gray-300 group-hover:text-white"></i>
                        </a>

                        <!-- YouTube -->
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-red-500/50"
                            style="background: #1f2937;"
                            onmouseover="this.style.background='linear-gradient(to right, #dc2626, #b91c1c)'"
                            onmouseout="this.style.background='#1f2937'">
                            <i class="fab fa-youtube text-gray-300 group-hover:text-white"></i>
                        </a>

                        <!-- LinkedIn -->
                        <a href="#"
                            class="group flex items-center justify-center w-10 h-10 bg-gray-800 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg hover:shadow-blue-500/50"
                            style="background: #1f2937;"
                            onmouseover="this.style.background='linear-gradient(to right, #0ea5e9, #0369a1)'"
                            onmouseout="this.style.background='#1f2937'">
                            <i class="fab fa-linkedin-in text-gray-300 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="lg:col-span-3">
                <p class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 rounded-full"
                        style="background: linear-gradient(to bottom, #22c55e, #14b8a6);"></span>
                    Quick Links
                </p>
                <ul class="space-y-3">
                    <li><a href="#"
                            class="group flex items-center text-gray-300 hover:text-green-400 transition-all duration-300">
                            <i class="fas fa-chevron-right w-4 mr-2 text-xs"></i> Beranda</a></li>
                    <li><a href="#"
                            class="group flex items-center text-gray-300 hover:text-green-400 transition-all duration-300">
                            <i class="fas fa-chevron-right w-4 mr-2 text-xs"></i> Tentang HMI</a></li>
                    <li><a href="#"
                            class="group flex items-center text-gray-300 hover:text-green-400 transition-all duration-300">
                            <i class="fas fa-chevron-right w-4 mr-2 text-xs"></i> Blog & Artikel</a></li>
                    <li><a href="#"
                            class="group flex items-center text-gray-300 hover:text-green-400 transition-all duration-300">
                            <i class="fas fa-chevron-right w-4 mr-2 text-xs"></i> Kegiatan</a></li>
                    <li><a href="#"
                            class="group flex items-center text-gray-300 hover:text-green-400 transition-all duration-300">
                            <i class="fas fa-chevron-right w-4 mr-2 text-xs"></i> Kontak</a></li>
                </ul>
            </div>

            <!-- Location Map -->
            <div class="lg:col-span-4">
                <p class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 rounded-full"
                        style="background: linear-gradient(to bottom, #22c55e, #14b8a6);"></span>
                    Lokasi Kami
                </p>
                <div class="relative group">
                    <div class="absolute -inset-1 rounded-xl opacity-50 group-hover:opacity-100 blur transition duration-300"
                        style="background: linear-gradient(to right, #16a34a, #0d9488);">
                    </div>
                    <div class="relative">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.3327120792183!2d111.48056237500568!3d-7.8602066921616345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a1000e524eab%3A0xe220beffd856d883!2sSekretariat%20HMI%20Cabang%20Ponorogo!5e0!3m2!1sid!2sid!4v1761780858649!5m2!1sid!2sid"
                            class="w-full h-48 rounded-xl border-2 border-gray-700" style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="mt-4 flex items-start gap-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700">
                    <i class="fas fa-map-marker-alt text-green-400 mt-1 text-lg"></i>
                    <div>
                        <p class="text-sm font-semibold text-white">Alamat Sekretariat HMI Cabang Ponorogo</p>
                        <p class="text-xs text-gray-400 mt-1">
                            Jl. Rumpuk No.91, Ronowijayan, Kertosari, Kec. Babadan, Kabupaten Ponorogo, Jawa Timur 63491
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-700/50 pt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-400">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="font-medium">© {{ date('Y') }} HMI Cabang Ponorogo</span>
                </div>
                <div class="flex items-center gap-4 text-xs text-gray-400">
                    <a href="#" class="hover:text-green-400 transition-colors">Privacy Policy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-green-400 transition-colors">Terms of Service</a>
                    <span>•</span>
                    <span>Made with <span class="text-red-500">❤️</span> by Media HMI</span>
                </div>
            </div>
        </div>
    </div>
</footer>
