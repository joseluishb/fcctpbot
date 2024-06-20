/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/**/*.blade.php", // Archivos Blade de Laravel
        "./resources/js/**/*.js", // Archivos JavaScript (para Alpine.js)
        "./resources/views/livewire/**/*.blade.php", // Archivos Blade de Livewire
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
