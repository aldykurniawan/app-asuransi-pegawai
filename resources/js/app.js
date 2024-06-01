import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

import Loading from "vue3-loading-overlay";
import "vue3-loading-overlay/dist/vue3-loading-overlay.css";

import moment from 'moment';
import "moment/dist/locale/id";

import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import FileComponent from "./Components/FileComponent.vue";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    // resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue')
        return pages[`./Pages/${name}.vue`]()

    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueSweetalert2)
            .component("v-select", vSelect)
            .component("loading-overlay", Loading)
            .component("VueDatePicker", VueDatePicker)
            .component("QuillEditor", QuillEditor)
            .component("file-component", FileComponent)
            .mixin({
                methods: {
                    moment,
                    hasAnyRole: function (roles) {
                        var allRoles = this.$page.props.auth.role;
                        var hasRole = false;
                        roles.forEach(function (item) {
                            if (allRoles[item]) hasRole = true;
                        });
                        return hasRole;
                    },
                    hasAnyPermission: function (permissions) {
                        const allPermissions = this.$page.props.auth.can;
                        let hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });
                        return hasPermission;
                    },
                },
                props: {
                    // pageInfo: Object,
                    // crumbs: Object,
                    errors: Object,
                },
            })
            .mount(el);
    },
    progress: {
        color: '#F59E0C',
        includeCSS: true,
        showSpinner: true
    },
});
