import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                "89rem": "89rem", // Adding custom max width
                "custom-wdth": "1028px",
            },
            height: {
                "4/7": "75%",
                "5/7": "90%", // Adding custom height (75%)
            },
            colors: {
                customblue: "#213555",
            },
            backgroundColor: {
                navyblue: "#213555", // Custom background light blue
            },
        },
    },

    plugins: [forms],
};
