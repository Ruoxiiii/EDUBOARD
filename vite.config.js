import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
        input: [
            'resources/css/app.css',
            'resources/css/welcome.css',
            'resources/css/announcements.css',
            'resources/css/profile.css',
            'resources/css/auth.css',
            'resources/css/admin.css',
            'resources/js/app.js',
            'resources/js/navbar.js',
            'resources/js/studentpage.js',
            'resources/js/admin.js',
            'resources/js/theme.js',
            'resources/js/profile.js',
            'resources/js/datefilter.js',
        ],
            refresh: true,
        }),
    ],
});
