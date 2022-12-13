const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: ['./src/**/*.js'],
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                white: '#ffffff',
                blue: {
                    DEFAULT: '#0c6ba8',
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#008eca',
                    600: '#0080bc',
                    700: '#00518c',
                    800: '#00326b',
                    900: '#002962',
                },
                gray: {
                    DEFAULT: '#f9fafb',
                    50: '#f9fafb',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#9ca3af',
                    500: '#6b7280',
                    600: '#4b5563',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827',
                },
                purple: {
                    DEFAULT: '#faf5ff',
                    50: '#faf5ff',
                    100: '#f3e8ff',
                    200: '#e9d5ff',
                    300: '#d8b4fe',
                    400: '#c084fc',
                    500: '#a855f7',
                    600: '#9333ea',
                    700: '#7e22ce',
                    800: '#6b21a8',
                    900: '#581c87',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },
    plugins: [require('@tailwindcss/forms')],
}
