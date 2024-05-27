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
                    DEFAULT: "#B2DFDB", // Color secundario
                    hover: "#A9D6D2", // Color secundario más oscuro para hover
                },
                tertiary: {
                    DEFAULT: "#317256", // Color terciario
                },
                lightSecondary: {
                    DEFAULT: "#E0F2F1", // Fondo más claro para los recuadros del perfil de usuario
                    hover: "#C8E5E2", // Color secundario más oscuro para hover
                },
            },

            maxWidth: {
                'carousel': '90rem',
            },
        },
    },
    plugins: [],
};


