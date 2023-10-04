import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';
import {toRGB, withOpacityValue} from "./resources/js/tailwind-helper";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    safelist: [
        {
            pattern: /(bg|text)-(success|danger|pending)-(100|800)/,
        },
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                rgb: toRGB(colors),
                primary: {
                    50: withOpacityValue("--color-primary-50"),
                    100: withOpacityValue("--color-primary-100"),
                    200: withOpacityValue("--color-primary-200"),
                    300: withOpacityValue("--color-primary-300"),
                    400: withOpacityValue("--color-primary-400"),
                    500: withOpacityValue("--color-primary-500"),
                    600: withOpacityValue("--color-primary-600"),
                    700: withOpacityValue("--color-primary-700"),
                    800: withOpacityValue("--color-primary-800"),
                    900: withOpacityValue("--color-primary-900"),
                },
                secondary: {
                    50: withOpacityValue("--color-secondary-50"),
                    100: withOpacityValue("--color-secondary-100"),
                    200: withOpacityValue("--color-secondary-200"),
                    300: withOpacityValue("--color-secondary-300"),
                    400: withOpacityValue("--color-secondary-500"),
                    500: withOpacityValue("--color-secondary-400"),
                    600: withOpacityValue("--color-secondary-600"),
                    700: withOpacityValue("--color-secondary-700"),
                    800: withOpacityValue("--color-secondary-800"),
                    900: withOpacityValue("--color-secondary-900"),
                },
                success: {
                    50: withOpacityValue("--color-success-50"),
                    100: withOpacityValue("--color-success-100"),
                    200: withOpacityValue("--color-success-200"),
                    300: withOpacityValue("--color-success-300"),
                    400: withOpacityValue("--color-success-400"),
                    500: withOpacityValue("--color-success-500"),
                    600: withOpacityValue("--color-success-600"),
                    700: withOpacityValue("--color-success-700"),
                    800: withOpacityValue("--color-success-800"),
                    900: withOpacityValue("--color-success-900"),
                },
                info: {
                    50: withOpacityValue("--color-info-50"),
                    100: withOpacityValue("--color-info-100"),
                    200: withOpacityValue("--color-info-200"),
                    300: withOpacityValue("--color-info-300"),
                    400: withOpacityValue("--color-info-400"),
                    500: withOpacityValue("--color-info-500"),
                    600: withOpacityValue("--color-info-600"),
                    700: withOpacityValue("--color-info-700"),
                    800: withOpacityValue("--color-info-800"),
                    900: withOpacityValue("--color-info-900"),
                },
                warning: {
                    50: withOpacityValue("--color-warning-50"),
                    100: withOpacityValue("--color-warning-100"),
                    200: withOpacityValue("--color-warning-200"),
                    300: withOpacityValue("--color-warning-300"),
                    400: withOpacityValue("--color-warning-400"),
                    500: withOpacityValue("--color-warning-500"),
                    600: withOpacityValue("--color-warning-600"),
                    700: withOpacityValue("--color-warning-700"),
                    800: withOpacityValue("--color-warning-800"),
                    900: withOpacityValue("--color-warning-900"),
                },
                pending: colors.amber,
                danger: {
                    50: withOpacityValue("--color-danger-50"),
                    100: withOpacityValue("--color-danger-100"),
                    200: withOpacityValue("--color-danger-200"),
                    300: withOpacityValue("--color-danger-300"),
                    400: withOpacityValue("--color-danger-400"),
                    500: withOpacityValue("--color-danger-500"),
                    600: withOpacityValue("--color-danger-600"),
                    700: withOpacityValue("--color-danger-700"),
                    800: withOpacityValue("--color-danger-800"),
                    900: withOpacityValue("--color-danger-900"),
                },
            }
        },
    },
    plugins: [forms],
};
