import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    daisyui: {
        themes: ["light", "dark", "cupcake"],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                inter: ['"Inter"', "sans-serif"],
                poppins: ['"Poppins"', "sans-serif"],
                merriweather: ['"Merriweather"', "serif"],
            },
        },
    },

    plugins: [forms, require("daisyui")],
};
