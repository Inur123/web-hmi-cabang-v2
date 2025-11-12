import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import forms from '@tailwindcss/forms'; // ← Import plugin

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss({
            // Vite akan otomatis baca config ini
            config: {
                plugins: [forms], // ← Aktifkan forms di sini
            },
        }),
    ],
});
