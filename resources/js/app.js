import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Layout from './Layouts/Layout.vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import $ from 'jquery';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import TipTap from '@/Components/Inputs/TipTap.vue';

library.add(fas, far, fab)

window.$ = window.jQuery = $;
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || Layout
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('font-awesome-icon', FontAwesomeIcon)
            .component('tiptap', TipTap)
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
    progress: {
        delay: 250,
        color: 'red',
        includeCSS: true,
        showSpinner: false,
      },
})
