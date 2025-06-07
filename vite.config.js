import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import removeConsole from 'vite-plugin-remove-console';

export default defineConfig({
  plugins: [
    vue(),
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    viteStaticCopy({
      targets: [
        { src: 'resources/assets/admin/css', dest: 'admin' },
        { src: 'resources/assets/admin/data', dest: 'admin' },
        { src: 'resources/assets/admin/fonts', dest: 'admin' },
        { src: 'resources/assets/admin/images', dest: 'admin' },
        { src: 'resources/assets/admin/js', dest: 'admin' },
        { src: 'resources/assets/client/images', dest: 'client' },
        { src: 'resources/assets/client/css', dest: 'client' },
      ],
    }),
    removeConsole(),
  ],
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
    },
  },
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    hmr: {
      host: '192.168.100.1',
    },
  },
  build: {
    minify: 'esbuild',
    sourcemap: false,
    target: 'es2015',
    chunkSizeWarningLimit: 500,
  },
});
