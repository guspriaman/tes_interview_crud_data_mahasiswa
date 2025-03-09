document.addEventListener("DOMContentLoaded", function() {
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");
    const navMenu = document.querySelector(".navmenu");
    const dropdownToggles = document.querySelectorAll(".toggle-dropdown");

    // Mobile Nav Toggle
    mobileNavToggleBtn.addEventListener("click", function() {
        document.body.classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    });

    // Dropdown Toggle
    dropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            const parent = this.parentNode;
            parent.classList.toggle("active");
        });
    });

    // Hide menu on link click (only for mobile)
    document.querySelectorAll("#navmenu a").forEach(link => {
        link.addEventListener("click", () => {
            if (document.body.classList.contains("mobile-nav-active")) {
                document.body.classList.remove("mobile-nav-active");
                mobileNavToggleBtn.classList.add("bi-list");
                mobileNavToggleBtn.classList.remove("bi-x");
            }
        });
    });
});
