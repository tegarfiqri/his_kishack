import './bootstrap';
import '../css/app.css';

import { createApp, h, computed  } from 'vue';
import { createInertiaApp, router, usePage } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faAngleLeft, faAngleRight, faArrowDown, faArrowUp, faArrowsUpDown, faUserSecret } from '@fortawesome/free-solid-svg-icons';

const appName = import.meta.env.VITE_APP_NAME || 'Article CMS';
library.add(faUserSecret, faArrowsUpDown, faAngleLeft, faAngleRight);
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
