import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';

import '../css/app.css';
import { router } from './router';
import Wrapper from "./Components/Wrapper.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.component("Wrapper", Wrapper);
        app.use(router);
        app.use(plugin);
        app.mount(el);
        
    },
    title: title => `${title} | Pililla`,
});