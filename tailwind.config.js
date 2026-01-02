import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

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
                'sky': colors.sky,
                'main-page': '#001366',
                'amber-100': '#fef3c7',
                'amber-200': '#fde68a',
                'accent': '',
                'success': '',
                'warning': '',
                'danger': '',
                'info': '',
                'light': '',
                'dark': '',
                'muted': '',
                'highlight': '',
                'soft': '',
                'bright': '',
            }
        },
    },
    plugins: [forms],
};
