document.addEventListener("DOMContentLoaded", function () {
    const toysDropdownButton = document.getElementById("toysDropdownButton");
    const toysDropdownMenu = document.getElementById("toysDropdownMenu");
    const logoutDropdownButton = document.getElementById(
        "logoutDropdownButton"
    );
    const logoutDropdownMenu = document.getElementById("logoutDropdownMenu");
    const userDropdownButton = document.getElementById("userDropdownButton");
    const userDropdownMenu = document.getElementById("userDropdownMenu");

    // Función para mostrar u ocultar el menú desplegable
    function toggleDropdown(button, menu) {
        menu.classList.toggle("hidden");
    }

    // Event listener para el dropdown de los juguetes
    if (toysDropdownButton != null) {
        toysDropdownButton.addEventListener("click", function () {
            toggleDropdown(toysDropdownButton, toysDropdownMenu);
            // Cerrar el dropdown de logout si está abierto
            if (!logoutDropdownMenu.classList.contains("hidden")) {
                toggleDropdown(logoutDropdownButton, logoutDropdownMenu);
            }
            // Cerrar el dropdown de usuario si está abierto
            if (!userDropdownMenu.classList.contains("hidden")) {
                toggleDropdown(userDropdownButton, userDropdownMenu);
            }
        });
    }
    if (logoutDropdownButton != null) {
        // Event listener para el dropdown de logout
        logoutDropdownButton.addEventListener("click", function () {
            toggleDropdown(logoutDropdownButton, logoutDropdownMenu);
            // Cerrar el dropdown de los juguetes si está abierto
            if (!toysDropdownMenu.classList.contains("hidden")) {
                toggleDropdown(toysDropdownButton, toysDropdownMenu);
            }
            // Cerrar el dropdown de usuario si está abierto
            if (!userDropdownMenu.classList.contains("hidden")) {
                toggleDropdown(userDropdownButton, userDropdownMenu);
            }
        });
    }
    if (userDropdownButton != null) {
        // Event listener para el dropdown de usuario
        userDropdownButton.addEventListener("click", function () {
            toggleDropdown(userDropdownButton, userDropdownMenu);
            // Cerrar el dropdown de los juguetes si está abierto
            if (!toysDropdownMenu.classList.contains("hidden")) {
                toggleDropdown(toysDropdownButton, toysDropdownMenu);
            }
            // Cerrar el dropdown de logout si está abierto
            if (!logoutDropdownMenu.classList.contains("hidden")) {
                toggleDropdown(logoutDropdownButton, logoutDropdownMenu);
            }
        });
    }
    // Cerrar los dropdowns cuando se hace clic fuera de ellos
    window.addEventListener("click", function (e) {
        if (
            toysDropdownButton &&
            !toysDropdownButton.contains(e.target) &&
            !toysDropdownMenu.contains(e.target)
        ) {
            toysDropdownMenu.classList.add("hidden");
        }
        if (
            logoutDropdownButton &&
            !logoutDropdownButton.contains(e.target) &&
            !logoutDropdownMenu.contains(e.target)
        ) {
            logoutDropdownMenu.classList.add("hidden");
        }
        if (
            userDropdownButton &&
            !userDropdownButton.contains(e.target) &&
            !userDropdownMenu.contains(e.target)
        ) {
            userDropdownMenu.classList.add("hidden");
        }
    });
});
