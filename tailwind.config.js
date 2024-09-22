import colors from "tailwindcss/colors.js";
import defaultTheme from "tailwindcss/defaultTheme.js";
import typography from "@tailwindcss/typography"
import forms from "@tailwindcss/forms"

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: ['class', '[data-theme="beatlink-dark"]'],
    theme: {
        extend: {
            colors: {
                "light": colors.white,
                "primary": colors.blue,
                "secondary": colors.slate,
                "dark": colors.blue,
                "ghost": colors.transparent,
                "success": colors.green,
                "error": colors.red,
                "warning": colors.orange,
            },
            fontFamily: {
                "sans": ['Poppins', defaultTheme.fontFamily.sans],
            },
        },
    },
    safelist: [
        {
            pattern:
                /^(bg-(?:light|primary|secondary|dark|ghost|success|error|warning)-(?:50|100|200|300|400|500|600|700|800|900|950))$/,
            variants: ['hover', 'active', 'focus', 'dark', 'dark:hover'],
        },
        {
            pattern:
                /^(border-(?:light|primary|secondary|dark|ghost|success|error|warning)-(?:50|100|200|300|400|500|600|700|800|900|950))$/,
            variants: ['hover', 'active', 'focus', 'dark', 'dark:hover'],
        },
        {
            pattern:
                /^(text-(?:light|primary|secondary|dark|ghost|success|error|warning)-(?:50|100|200|300|400|500|600|700|800|900|950))$/,
            variants: ['hover', 'active', 'focus', 'dark', 'dark:hover'],
        },
        {
            pattern:
                /^(fill-(?:light|primary|secondary|dark|ghost|success|error|warning)-(?:50|100|200|300|400|500|600|700|800|900|950))$/,
            variants: ['hover', 'active', 'focus', 'dark', 'dark:hover'],
        },
    ],
    plugins: [
        typography,
        forms,
    ],
};
