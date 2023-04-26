const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php',
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                fuchsia: {
                    '50': '#fdf0f5',
                    '100': '#f9c5d5',
                    '200': '#f698b5',
                    '300': '#f36b95',
                    '400': '#f13d75',
                    '500': '#f50082', // color principal
                    '600': '#d2006c',
                    '700': '#a8005a',
                    '800': '#7e0045',
                    '900': '#4e002d',
                },

                magenta: {
                    '50': '#fdf0f5',
                    '100': '#f9c5d5',
                    '200': '#f698b5',
                    '300': '#f36b95',
                    '400': '#f13d75',
                    '500': '#f50082', // color principal
                    '600': '#d2006c',
                    '700': '#a8005a',
                    '800': '#7e0045',
                    '900': '#4e002d',
                },

                darkblue: {
                    '50': '#f5f5ff',
                    '100': '#d9d9f2',
                    '200': '#b3b3e6',
                    '300': '#8c8cd9',
                    '400': '#6666cc',
                    '500': '#00005A', // color principal
                    '600': '#00004d',
                    '700': '#000040',
                    '800': '#000033',
                    '900': '#000026',
                },

                /* fuchsia: "#00005A", */
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar'),
    ],
};
