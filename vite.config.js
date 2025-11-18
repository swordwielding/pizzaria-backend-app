import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/global.css', 'resources/css/product-form.css', 'resources/css/products.css'],
            refresh: true,
        }),
    ],
});
