import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#09425F',
                secondary: '#06739C',
                tertiary: '#16B0CA',
                muda: '#B1D3E4',
                background: '#F3F8FF',
                abubiru: '#6796AB'
            },
            keyframes: {
                shake: {
                    '0%, 100%': { transform: 'translateX(0) translateY(0)' },
                    '25%': { transform: 'translateY(-5px)' },
                    '50%': { transform: 'translateY(5px)' },
                    '75%': { transform: 'translateY(-5px)' },
                },
                fadeIn: {
                  '0%': { opacity: '0' },
                  '100%': { opacity: '1' },
                },
                fadeInUp: {
                  '0%': { opacity: '0', transform: 'translateY(20px)' },
                  '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideDown: {
                  '0%': { transform: 'translateY(-100%)' },
                  '100%': { transform: 'translateY(0)' },
                },
                slideLeft: {
                  '0%': { transform: 'translateX(100%)' },
                  '100%': { transform: 'translateX(0)' },
                },
                slideRight: {
                  '0%': { transform: 'translateX(-100%)' },
                  '100%': { transform: 'translateX(0)' },
                },
                float: {
                  '0%, 100%': { transform: 'translateY(0)' },
                  '50%': { transform: 'translateY(-20px)' },
                },
            },
            animation: {
                shake: 'shake 3s infinite',
                'fade-in': 'fadeIn 1s ease-in',
                'fade-in-up': 'fadeInUp 1s ease-out',
                'slide-down': 'slideDown 1s ease-out',
                'slide-left': 'slideLeft 1s ease-out',
                'slide-right': 'slideRight 1s ease-out',
                'float': 'float 3s ease-in-out infinite',
            },
        },
    },

    plugins: [forms, typography],
};
