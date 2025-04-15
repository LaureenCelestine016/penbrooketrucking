import "./bootstrap";
import "../css/app.css";
import "leaflet/dist/leaflet.css";
import "primeicons/primeicons.css";
import "vue-tel-input/vue-tel-input.css";
import Echo from "laravel-echo";
import Pusher from "pusher-js";

import Tooltip from "primevue/tooltip";

import { createApp, h } from "vue";
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import ToastService from "primevue/toastservice";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { definePreset } from "@primevue/themes";
import { TinyColor } from "@ctrl/tinycolor";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

window.Pusher = Pusher;

const baseColor = "#213555";

// Create a new instance with `new`
const lightShade = new TinyColor(baseColor).lighten(20).toHexString(); // Lighter shade
const darkShade = new TinyColor(baseColor).darken(20).toHexString(); // Darker shade

const MyPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: new TinyColor(baseColor).lighten(40).toHexString(),
            100: new TinyColor(baseColor).lighten(30).toHexString(),
            200: new TinyColor(baseColor).lighten(20).toHexString(),
            300: new TinyColor(baseColor).lighten(10).toHexString(),
            400: new TinyColor(baseColor).lighten(5).toHexString(),
            500: baseColor, // Main color
            600: new TinyColor(baseColor).darken(5).toHexString(),
            700: new TinyColor(baseColor).darken(10).toHexString(),
            800: new TinyColor(baseColor).darken(20).toHexString(),
            900: new TinyColor(baseColor).darken(30).toHexString(),
            950: new TinyColor(baseColor).darken(40).toHexString(),
        },
    },
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                    options: {
                        darkModeSelector: ".app-dark",
                        cssLayer: false,
                    },
                },
            })
            .use(ZiggyVue)
            .use(ToastService)
            .directive("tooltip", Tooltip) // Use `directive` for PrimeVue tooltips
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

const activeChats = []; // Probably reactive or managed via Vuex/Pinia/composable
