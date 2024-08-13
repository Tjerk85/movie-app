import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'movies.localhost',
        },
        https: {
            key: '/var/www/html/docker/cert/movies.localhost.key',
            cert: '/var/www/html/docker/cert/movies.localhost.crt',
        },
        port: 5173,
    }
});
