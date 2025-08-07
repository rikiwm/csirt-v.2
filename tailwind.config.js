import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // fontSize: {
            //     xs: ['1.3rem', {lineHeight: '2.5rem'}],
            //     sm: ['1.4rem', {lineHeight: '2.7rem'}],
            //     base: ['1.6rem', {lineHeight: '2.8rem'}],
            //     // etc
            // }
        },
    },
    plugins: [],
};
