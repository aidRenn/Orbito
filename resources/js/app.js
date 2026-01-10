import Alpine from "alpinejs";

window.featuredCarousel = function (items) {
    return {
        items,
        index: 0,
        interval: null,
        visible: true,

        get currentMain() {
            return this.items[this.index] ?? null;
        },

        get currentSecondary() {
            return this.items[this.index + 1] ?? this.items[0] ?? null;
        },

        start() {
            if (this.items.length <= 2) return;

            this.interval = setInterval(() => {
                this.visible = false;

                setTimeout(() => {
                    this.index += 2;
                    if (this.index >= this.items.length) this.index = 0;
                    this.visible = true;
                }, 300);
            }, 6000);
        },
    };
};

window.Alpine = Alpine;
Alpine.start();

import "./navbar";
import "./hero";
import "./showcase";
import "./experience";
