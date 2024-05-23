/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screen: {
            sm: "576px",
            md: "768px",
            lg: "992px",
            xl: "1200px",
        },
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#7FFFD4", // Verde agua como color primario
                },
            },
        },
    },
    plugins: [],
};
