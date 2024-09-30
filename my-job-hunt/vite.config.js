import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/calculators/takeHomePay.ts',
                'resources/js/calculators/takeHomePay.css',
            ],
            refresh: true,
        }),
    ],
});
