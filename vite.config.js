import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import livewire from '@defstudio/vite-livewire-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/my-editor/my-editor.js',
            ],
            refresh: true,
        }),

        livewire({
            // refresh css (tailwind ) as well
            refresh: ['resources/js/my-editor/my-editor.js'],
        }),
    ],
});


