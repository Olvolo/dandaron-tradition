import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Основные цвета проекта
                'main-page': '#001366',
                'primary': '',           // bg-primary, text-primary
                'secondary': '',         // bg-secondary, text-secondary
                'accent': '',            // bg-accent, text-accent

                // Цвета состояний
                'success': '',           // bg-success, text-success
                'warning': '',           // bg-warning, text-warning
                'danger': '',            // bg-danger, text-danger
                'info': '',              // bg-info, text-info

                // Нейтральные цвета
                'light': '',             // bg-light, text-light
                'dark': '',              // bg-dark, text-dark
                'muted': '',             // bg-muted, text-muted

                // Дополнительные цвета
                'highlight': '',         // bg-highlight, text-highlight
                'soft': '',              // bg-soft, text-soft
                'bright': '',            // bg-bright, text-bright
            }
        },
    },
    plugins: [forms],
};
