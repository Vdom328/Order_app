import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',
                'resources/css/admin/setting_food.css',
                'resources/js/common.js'
            ],
            refresh: true,
        }),
    ],
});
