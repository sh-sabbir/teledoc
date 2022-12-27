import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const submenuTargets = document.querySelectorAll("[data-submenu-target]");

submenuTargets.forEach((target) => {
    target.addEventListener("click", (event) => {
        event.preventDefault();
        const submenuId = target.getAttribute("data-submenu-target");
        const submenu = document.getElementById(submenuId);
        // toggle the submenu's visibility
        submenu.classList.toggle("hidden");
    });
});
