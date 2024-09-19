import colors from "tailwindcss/colors.js";
import defaultTheme from "tailwindcss/defaultTheme.js";


/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/js/**/*.vue',
    ],
    darkMode: ['class', '[data-theme="beatlink-dark"]'],
    theme: {
        extend: {
            colors: {
                "primary": colors.blue,
                "secondary": colors.gray,
                "neutral": colors.white,
                "accent": colors.blue,
            },
            fontFamily: {
                "sans": ['Poppins', defaultTheme.fontFamily.sans],
            },
            fontWeight: {
                thin: '100',
                hairline: '100',
                light: '300',
                normal: '400',
                medium: '500',
                semibold: '600',
                bold: '700',
                black: '900',
            }
        }
    },
    safelist: [
        {
            pattern: /(alert|badge|btn|loading|progress|radial-progress|toast|tooltip|input|checkbox|radio|range|mask|select|textarea|toggle|text|bg|navbar)/
        },
    ],
    daisyui: {
        base: false,
        styled: true,
        utils: true,
        themes: [
            {
                "beatlink-light": {
                    "color-scheme": "light",
                    "primary": colors.blue['600'],
                    "secondary": colors.gray['100'],
                    "error": colors.red['600'],
                    "success": colors.green['500'],
                    "success-content": colors.white,
                    "error-content": colors.red['100'],
                    "secondary-content": colors.gray['900'],
                    "accent": colors.blue['600'],
                    "neutral": colors.blue['50'],
                    "neutral-content": colors.black,
                    "base-100": colors.blue['100'],
                    "base-200": colors.blue['200'],
                    "base-300": colors.blue['300'],
                    "base-content": colors.blue['900'],
                },
                "beatlink-dark": {
                    "color-scheme": "dark",
                    "primary": colors.blue['700'],
                    "secondary": colors.gray['800'],
                    "error": colors.red['600'],
                    "error-content": colors.red['100'],
                    "success": colors.green['600'],
                    "success-content": colors.white,
                    "secondary-content": colors.gray['300'],
                    "accent": colors.blue['100'],
                    "neutral": colors.blue['900'],
                    "neutral-content": colors.white,
                    "base-100": colors.blue['950'],
                    "base-200": colors.gray['900'],
                    "base-300": colors.gray['800'],
                    "base-content": colors.blue['100'],
                },
            },
        ],
    },
    plugins: [
        require('daisyui'),
    ],
};
