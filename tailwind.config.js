/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#1447E6', // primary blue
                    dark: '#1138c2',    // hover shade, derived from brand blue
                    soft: '#EAF0FE',    // light blue tint (icon chips, badges)
                },
                navy: '#0B2A8C',        // dark blue — headings, dark bands
                surface: '#FDFFFF',    // near-white background (cards)
                page: '#F6F8FF',        // near-white page background
                line: '#E2E7F7',        // hairline borders
                ink: {
                    DEFAULT: '#101425', // main text (neutral, not brand)
                    soft: '#5B6178',    // secondary text (neutral, not brand)
                },
                accent: {
                    DEFAULT: '#0B2A8C', // badges / checkmarks — same navy family
                    soft: '#E7ECFB',
                },
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                display: ['"Space Grotesk"', 'ui-sans-serif', 'system-ui'],
                mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
            },
        },
    },
    plugins: [],
};