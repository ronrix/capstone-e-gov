import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';

import '../css/app.css';
import Wrapper from "./Components/Wrapper.vue";
import DarkMode from "./Components/DarkMode.vue";
import WrapperContent from "./Components/WrapperContent.vue";
import { router } from './router';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.component("Wrapper", Wrapper);
        app.component("DarkMode", DarkMode);
        app.component("WrapperContent", WrapperContent);
        app.use(router);
        app.use(plugin);
        app.mount(el);
        
    },
    title: title => `${title} | Pililla`,
});