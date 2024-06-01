import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import inject from "@rollup/plugin-inject";
import commonjs from "vite-plugin-commonjs";

export default defineConfig({
    plugins: [
        commonjs(),
        laravel({
            buildDirectory: "build",
            input: "resources/js/app.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        inject({
            "window.Quill": ["@vueup/vue-quill", "Quill"],
            Quill: ["@vueup/vue-quill", "Quill"],
            "window.imageResize": ["quill-image-resize-module", "imageResize"],
            imageResize: ["quill-image-resize-module", "imageResize"],
            // "window.L": ["leaflet", "L"],
            // L: ["leaflet", "L"],
            // "window.VueLeaflet": ["@vue-leaflet/vue-leaflet", "VueLeaflet"],
            // VueLeaflet: ["@vue-leaflet/vue-leaflet", "VueLeaflet"],
        }),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "@": "/resources/js",
            "@fe": path.resolve(__dirname, "/resources/fe"),
            // "@fe": "/resources/js",
        },
    },
    optimizeDeps: {
        include: ["quill-image-resize-module"], // Gantilah 'library-name' dengan nama pustaka yang relevan.
    },
});
