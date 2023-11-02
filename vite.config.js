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
                'resources/css/client/auth/style.css',
                'resources/css/client/common.css',
                'resources/css/client/order_now.css',
                'resources/css/client/foodter.css',
                'resources/css/client/detail.css',
                'resources/css/client/list-cart.css',
                'resources/js/common.js',
                'resources/js/client/app.js',

            ],
            refresh: true,
        }),
    ],
});
