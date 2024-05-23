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
                    DEFAULT: "#398564", // Verde agua como color primario
                },
                secondary: {
                    DEFAULT: "#66b2b2", // Color secundario
                },
                tertiary: {
                    DEFAULT: "#317256", // Color terciario
                },
            },
        },
    },
    plugins: [],
};


