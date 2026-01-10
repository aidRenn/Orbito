import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    const section = document.getElementById("work");
    if (!section) return;

    gsap.fromTo(section, { opacity: 0 }, { opacity: 1, duration: 1.5 });

    gsap.utils.toArray(".showcase-card").forEach((card, index) => {
        gsap.fromTo(
            card,
            { y: 50, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1,
                delay: 0.3 * (index + 1),
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                },
            }
        );
    });
});
