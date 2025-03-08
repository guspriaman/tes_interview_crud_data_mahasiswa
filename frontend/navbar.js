// frontend/navbar.js
document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector(".nav-links");

    // Toggle menu pada mode mobile
    toggleButton.addEventListener("click", function () {
        navLinks.classList.toggle("active");
    });

    // Menutup menu jika pengguna mengklik di luar
    document.addEventListener("click", function (event) {
        if (!toggleButton.contains(event.target) && !navLinks.contains(event.target)) {
            navLinks.classList.remove("active");
        }
    });
});
