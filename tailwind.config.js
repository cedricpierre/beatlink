import colors from "tailwindcss/colors.js";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    daisyui: {
        darkTheme: "dark",
        base: false,
        styled: true,
        utils: true,
        themes: [
            {
                "beatlink": {
                    "color-scheme": "light",
                    "primary": colors.blue['600'],
                    "secondary": colors.gray['100'],
                    "error": colors.red['600'],
                    "secondary-content": colors.gray['900'],
                    "accent": colors.blue['600'],
                    "neutral": colors.gray['600'],
                    "neutral-content": colors.gray['100'],
                    "base-100": colors.white,
                    "base-200": colors.gray['50'],
                    "base-300": colors.gray['100'],
                    "base-content": colors.blue['600'],
                },
            },
        ],
    },
    plugins: [
        require('flowbite/plugin'),
        require('daisyui'),
    ],
};
