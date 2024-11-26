const defaultTheme = require('tailwindcss/defaultTheme');
const forms = require('@tailwindcss/forms');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "theme-heading": ["'Exo 2'", "sans-serif"],
            "theme-content": ["Alegreya Sans", "sans-serif"],
            },
            colors: {
                "theme-primary": "#E8BCB9",
                "theme-secondary": "#FA5757",
                "theme-grayish-blue": "#3C3D37",
                "theme-dark-blue": "rgb(37, 43, 70)",
                "theme-dark-blue-tp": "rgba(37, 43, 70, 0.9)",
                primary: '#c58a61',
                secondary: '#281c11',
                accent: '#c59461',
                highlight: '#a7674d',
                dark: '#543434',
            },
        },
    },

    darkMode: 'class', // Enable dark mode using a class

    plugins: [forms],
};
