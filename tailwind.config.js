import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js', // Tambahan aman agar deteksi js
    ],

    theme: {
        extend: {
            fontFamily: {
                // Mengubah Figtree menjadi Inter sesuai desain premium kamu
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // WAJIB DITAMBAHKAN: Warna custom dari desain HTML kamu
                brand: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    500: '#3b82f6',
                    600: '#2563eb', 
                    800: '#1e40af', 
                    900: '#1e3a8a', 
                    950: '#0f172a',
                }
            }
        },
    },

    plugins: [forms],
};