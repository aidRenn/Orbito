document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    const onScroll = () => {
        if (window.scrollY > 10) {
            navbar.classList.add("scrolled");
            navbar.classList.remove("not-scrolled");
        } else {
            navbar.classList.add("not-scrolled");
            navbar.classList.remove("scrolled");
        }
    };

    onScroll();
    window.addEventListener("scroll", onScroll);
});
