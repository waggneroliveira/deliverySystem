import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/assets/client/css/main.css',],
            refresh: true,
        }),

        viteStaticCopy({
            targets: [
                {
                    src: 'resources/assets/admin/css',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/data',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/fonts',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/images',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/admin/js',
                    dest: 'admin'
                },
                {
                    src: 'resources/assets/client/images',
                    dest: 'client'
                },
                {
                    src: 'resources/assets/client/css',
                    dest: 'client'
                },
            ]
        })
    ],
    resolve:{
        alias:{
            vue:'vue/dist/vue.esm-bundler.js'
        }
    },
    server: {
        host: '0.0.0.0', // Permite acesso externo
        port: 5173, 
        strictPort: true, // Garante que o Vite não mude a porta
        hmr: {
            host: '192.168.15.14' 
        }
    }
});
