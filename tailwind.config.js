import colors from "tailwindcss/colors.js";

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: ['class', '[data-theme="beatlink-dark"]'],
    daisyui: {
        base: false,
        styled: true,
        utils: true,
        themes: [
            {
                "beatlink-dark": {
                    "color-scheme": "dark",
                    "primary": colors.blue['700'],
                    "secondary": colors.gray['800'],
                    "error": colors.red['600'],
                    "secondary-content": colors.gray['300'],
                    "accent": colors.blue['100'],
                    "neutral": colors.blue['900'],
                    "neutral-content": colors.white,
                    "base-100": colors.blue['950'],
                    "base-200": colors.gray['900'],
                    "base-300": colors.gray['800'],
                    "base-content": colors.blue['100'],
                },
                "beatlink-light": {
                    "color-scheme": "light",
                    "primary": colors.blue['600'],
                    "secondary": colors.gray['100'],
                    "error": colors.red['600'],
                    "secondary-content": colors.gray['900'],
                    "accent": colors.blue['600'],
                    "neutral": colors.white,
                    "neutral-content": colors.black,
                    "base-100": colors.white,
                    "base-200": colors.gray['50'],
                    "base-300": colors.gray['100'],
                    "base-content": colors.blue['600'],
                },
            },
        ],
    },
    plugins: [
        require('daisyui'),
    ],
};

console.log(colors.blue)
