import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
	host: "192.168.18.86",
	port: 5174
    },
    plugins: [
        laravel({
            input: [
                'resouraces/css/app.css',
                'resources/js/app.js',
                'resources/css/filament/operator/theme.css',
            ],
            refresh: false,
        }),
    ],
});
