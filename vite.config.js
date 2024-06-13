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
        port: 8080,
        https: false,
        hmr: {
            clientPort: 8080,
            host: 'movie-app.localhost',
            protocol: 'ws'
        },
        watch: {
            usePolling: true,
        }
    }
});
