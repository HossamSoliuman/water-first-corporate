/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#EFF8FF', 100: '#D9EEFF', 200: '#B7DFFF', 300: '#7CC6F4', 400: '#3FA9DE',
                    500: '#1686C4', 600: '#07579A', 700: '#06497F', 800: '#083D68', 900: '#0B3457', 950: '#072139',
                },
                secondary: {
                    50: '#F0F8FD', 100: '#DDEEF9', 200: '#BEDFF2', 300: '#90C9E8', 400: '#55A9D8',
                    500: '#1976B8', 600: '#1567A1', 700: '#135383', 800: '#14466D', 900: '#153B5B', 950: '#0E263D',
                },
                accent: {
                    50: '#ECFEFE', 100: '#D0FAFA', 200: '#A5F3F3', 300: '#67E5E5', 400: '#22CCCC',
                    500: '#00A6A6', 600: '#008888', 700: '#076C6C', 800: '#0B5656', 900: '#0D4747', 950: '#052C2C',
                },
                ink: {
                    50: '#F3F8FB', 100: '#E5F0F6', 200: '#C9DEE9', 300: '#9FC4D5', 400: '#6FA2BA',
                    500: '#4B829D', 600: '#38677F', 700: '#2D5367', 800: '#12324A', 900: '#0B2437', 950: '#061722',
                },
                surface: '#F5FBFE',
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                heading: ['Sora', 'ui-sans-serif', 'system-ui'],
                mono: ['IBM Plex Mono', 'ui-monospace', 'monospace'],
            },
            typography: { DEFAULT: { css: { maxWidth: 'none' } } },
        },
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
