import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// const submenuTargets = document.querySelectorAll("[data-submenu-target]");

// submenuTargets.forEach((target) => {
//     target.addEventListener("click", (event) => {
//         event.preventDefault();
//         const submenuId = target.getAttribute("data-submenu-target");
//         const submenu = document.getElementById(submenuId);

//         // close any other open submenus
//         const openSubmenus = document.querySelectorAll(".submenu:not(.hidden)");
//         openSubmenus.forEach((submenu) => submenu.classList.add("hidden"));

//         // toggle the submenu's visibility
//         submenu.classList.toggle("hidden");
//     });
// });

const submenuTargets = document.querySelectorAll("[data-submenu-target]");

submenuTargets.forEach((target) => {
    target.addEventListener("click", (event) => {
        event.preventDefault();
        const menuId = target.getAttribute("data-submenu-target");
        const submenu = document.querySelector(`[data-menu-id="${menuId}"]`);

        // close any other open submenus
        const openSubmenus = document.querySelectorAll(".submenu:not(.hidden)");
        openSubmenus.forEach((submenu) => submenu.classList.add("hidden"));

        // toggle the clicked submenu's visibility
        submenu.classList.toggle("hidden");
    });
});
