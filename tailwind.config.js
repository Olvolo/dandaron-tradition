/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/Livewire/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                'sky': {
                    'light': '#87CEEB', // Светло-небесный
                    'DEFAULT': '#00BFFF', // Глубокий небесно-голубой
                    'dark': '#1E90FF',  // Темно-небесный
                },
                'golden': {
                    'light': '#FFD700', // Светло-золотой
                    'DEFAULT': '#DAA520', // Золотистый
                    'dark': '#B8860B',   // Темно-золотой
                }
            }
        },
    },
    plugins: [],
}
