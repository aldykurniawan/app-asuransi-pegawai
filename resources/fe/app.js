import './bootstrap';
import '../css/app-fe.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'TSG';

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
            .component("v-select", vSelect)
            .mixin({
                methods: {
                    // moment,
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
                    // title: String,
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
