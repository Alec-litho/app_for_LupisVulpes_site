import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css', 
                'resources/js/app.js',
                // 'resources/js/color-thief.umd.js',
                // 'resources/js/identifyBaseColor.js',
                // 'resources/js/loadImg.js',
                // 'resources/js/scripts.js',
                // 'resources/js/setColors.js'
        ],
            refresh: true,
        }),
    ],
});
