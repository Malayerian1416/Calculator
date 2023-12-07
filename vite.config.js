import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            publicDirectory: 'public_html',
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue()
    ],
    resolve: {
        alias: {
            ziggy: 'vendor/tightenco/ziggy/dist/index.js',
            ziggyVue: 'vendor/tightenco/ziggy/dist/vue.es.js'
        },
    },
});
