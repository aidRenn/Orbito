import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    // CARD SLIDE IN
    gsap.utils.toArray(".timeline-card").forEach((card) => {
        gsap.from(card, {
            xPercent: -100,
            opacity: 0,
            duration: 1,
            ease: "power2.inOut",
            scrollTrigger: {
                trigger: card,
                start: "top 80%",
            },
        });
    });

    // TIMELINE SCALE
    const timeline = document.querySelector(".timeline");
    if (timeline) {
        gsap.to(timeline, {
            scaleY: 0,
            transformOrigin: "bottom bottom",
            ease: "power1.inOut",
            scrollTrigger: {
                trigger: timeline,
                start: "top center",
                end: "70% center",
                scrub: true,
            },
        });
    }

    // TEXT FADE IN
    gsap.utils.toArray(".expText").forEach((text) => {
        gsap.from(text, {
            opacity: 0,
            duration: 1,
            ease: "power2.inOut",
            scrollTrigger: {
                trigger: text,
                start: "top 60%",
            },
        });
    });
});
