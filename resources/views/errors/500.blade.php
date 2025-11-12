<!-- filepath: /Users/muhammadzainurroziqin/Documents/coding/website-cabang-hmi/resources/views/errors/500.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | HMI CABANG PONOROGO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center px-4">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Code -->
        <div class="mb-8" data-aos="fade-down">
            <h1
                class="text-8xl sm:text-9xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 animate-pulse">
                500
            </h1>
        </div>

        <!-- Icon -->
        <div class="mb-8 flex justify-center" data-aos="fade-up" data-aos-delay="100">
            <div
                class="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/20 dark:to-pink-900/20 flex items-center justify-center shadow-xl">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-16 sm:h-20 sm:w-20 text-purple-600 dark:text-purple-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>

        <!-- Message -->
        <div class="mb-8 space-y-4" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                Terjadi Kesalahan Server
            </h2>
            <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                Maaf, terjadi kesalahan pada server kami. Tim teknis kami sedang menangani masalah ini. Silakan coba
                lagi nanti.
            </p>
        </div>

        <!-- Actions -->

    </div>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>

</html>
