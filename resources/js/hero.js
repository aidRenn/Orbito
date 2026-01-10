import gsap from "gsap";

document.addEventListener("DOMContentLoaded", () => {
    const headers = document.querySelectorAll(".hero-text h1");
    if (!headers.length) return;

    gsap.fromTo(
        headers,
        { y: 50, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            stagger: 0.2,
            duration: 1,
            ease: "power2.inOut",
        }
    );
});
