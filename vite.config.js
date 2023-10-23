import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',
                'resources/css/client/layouts.css',
                'resources/css/admin/setting_food.css',
                'resources/css/client/style.css',
                'resources/css/client/home.css',
                'resources/js/common.js',
                'resources/js/client/app.js',
            ],
            refresh: true,
        }),
    ],
});
