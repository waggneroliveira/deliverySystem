// vite.config.js
import { defineConfig } from "file:///C:/laragon/www/wagner/clientesPessoais/deliverySystem/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/laragon/www/wagner/clientesPessoais/deliverySystem/node_modules/laravel-vite-plugin/dist/index.js";
import vue from "file:///C:/laragon/www/wagner/clientesPessoais/deliverySystem/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import { viteStaticCopy } from "file:///C:/laragon/www/wagner/clientesPessoais/deliverySystem/node_modules/vite-plugin-static-copy/dist/index.js";
import removeConsole from "file:///C:/laragon/www/wagner/clientesPessoais/deliverySystem/node_modules/vite-plugin-remove-console/dist/index.mjs";
var vite_config_default = defineConfig({
  plugins: [
    vue(),
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true
    }),
    viteStaticCopy({
      targets: [
        { src: "resources/assets/admin/css", dest: "admin" },
        { src: "resources/assets/admin/data", dest: "admin" },
        { src: "resources/assets/admin/fonts", dest: "admin" },
        { src: "resources/assets/admin/images", dest: "admin" },
        { src: "resources/assets/admin/js", dest: "admin" },
        { src: "resources/assets/client/images", dest: "client" },
        { src: "resources/assets/client/css", dest: "client" }
      ]
    }),
    removeConsole()
  ],
  resolve: {
    alias: {
      vue: "vue/dist/vue.esm-bundler.js"
    }
  },
  server: {
    host: "0.0.0.0",
    port: 5173,
    strictPort: true,
    hmr: {
      host: "192.168.100.1"
    }
  },
  build: {
    minify: "esbuild",
    sourcemap: false,
    target: "es2015",
    chunkSizeWarningLimit: 500
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxsYXJhZ29uXFxcXHd3d1xcXFx3YWduZXJcXFxcY2xpZW50ZXNQZXNzb2Fpc1xcXFxkZWxpdmVyeVN5c3RlbVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcbGFyYWdvblxcXFx3d3dcXFxcd2FnbmVyXFxcXGNsaWVudGVzUGVzc29haXNcXFxcZGVsaXZlcnlTeXN0ZW1cXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L2xhcmFnb24vd3d3L3dhZ25lci9jbGllbnRlc1Blc3NvYWlzL2RlbGl2ZXJ5U3lzdGVtL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJztcbmltcG9ydCB7IHZpdGVTdGF0aWNDb3B5IH0gZnJvbSAndml0ZS1wbHVnaW4tc3RhdGljLWNvcHknO1xuaW1wb3J0IHJlbW92ZUNvbnNvbGUgZnJvbSAndml0ZS1wbHVnaW4tcmVtb3ZlLWNvbnNvbGUnO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICBwbHVnaW5zOiBbXG4gICAgdnVlKCksXG4gICAgbGFyYXZlbCh7XG4gICAgICBpbnB1dDogWydyZXNvdXJjZXMvY3NzL2FwcC5jc3MnLCAncmVzb3VyY2VzL2pzL2FwcC5qcyddLFxuICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICB9KSxcbiAgICB2aXRlU3RhdGljQ29weSh7XG4gICAgICB0YXJnZXRzOiBbXG4gICAgICAgIHsgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9jc3MnLCBkZXN0OiAnYWRtaW4nIH0sXG4gICAgICAgIHsgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9kYXRhJywgZGVzdDogJ2FkbWluJyB9LFxuICAgICAgICB7IHNyYzogJ3Jlc291cmNlcy9hc3NldHMvYWRtaW4vZm9udHMnLCBkZXN0OiAnYWRtaW4nIH0sXG4gICAgICAgIHsgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9pbWFnZXMnLCBkZXN0OiAnYWRtaW4nIH0sXG4gICAgICAgIHsgc3JjOiAncmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9qcycsIGRlc3Q6ICdhZG1pbicgfSxcbiAgICAgICAgeyBzcmM6ICdyZXNvdXJjZXMvYXNzZXRzL2NsaWVudC9pbWFnZXMnLCBkZXN0OiAnY2xpZW50JyB9LFxuICAgICAgICB7IHNyYzogJ3Jlc291cmNlcy9hc3NldHMvY2xpZW50L2NzcycsIGRlc3Q6ICdjbGllbnQnIH0sXG4gICAgICBdLFxuICAgIH0pLFxuICAgIHJlbW92ZUNvbnNvbGUoKSxcbiAgXSxcbiAgcmVzb2x2ZToge1xuICAgIGFsaWFzOiB7XG4gICAgICB2dWU6ICd2dWUvZGlzdC92dWUuZXNtLWJ1bmRsZXIuanMnLFxuICAgIH0sXG4gIH0sXG4gIHNlcnZlcjoge1xuICAgIGhvc3Q6ICcwLjAuMC4wJyxcbiAgICBwb3J0OiA1MTczLFxuICAgIHN0cmljdFBvcnQ6IHRydWUsXG4gICAgaG1yOiB7XG4gICAgICBob3N0OiAnMTkyLjE2OC4xMDAuMScsXG4gICAgfSxcbiAgfSxcbiAgYnVpbGQ6IHtcbiAgICBtaW5pZnk6ICdlc2J1aWxkJyxcbiAgICBzb3VyY2VtYXA6IGZhbHNlLFxuICAgIHRhcmdldDogJ2VzMjAxNScsXG4gICAgY2h1bmtTaXplV2FybmluZ0xpbWl0OiA1MDAsXG4gIH0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBNlYsU0FBUyxvQkFBb0I7QUFDMVgsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sU0FBUztBQUNoQixTQUFTLHNCQUFzQjtBQUMvQixPQUFPLG1CQUFtQjtBQUUxQixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixTQUFTO0FBQUEsSUFDUCxJQUFJO0FBQUEsSUFDSixRQUFRO0FBQUEsTUFDTixPQUFPLENBQUMseUJBQXlCLHFCQUFxQjtBQUFBLE1BQ3RELFNBQVM7QUFBQSxJQUNYLENBQUM7QUFBQSxJQUNELGVBQWU7QUFBQSxNQUNiLFNBQVM7QUFBQSxRQUNQLEVBQUUsS0FBSyw4QkFBOEIsTUFBTSxRQUFRO0FBQUEsUUFDbkQsRUFBRSxLQUFLLCtCQUErQixNQUFNLFFBQVE7QUFBQSxRQUNwRCxFQUFFLEtBQUssZ0NBQWdDLE1BQU0sUUFBUTtBQUFBLFFBQ3JELEVBQUUsS0FBSyxpQ0FBaUMsTUFBTSxRQUFRO0FBQUEsUUFDdEQsRUFBRSxLQUFLLDZCQUE2QixNQUFNLFFBQVE7QUFBQSxRQUNsRCxFQUFFLEtBQUssa0NBQWtDLE1BQU0sU0FBUztBQUFBLFFBQ3hELEVBQUUsS0FBSywrQkFBK0IsTUFBTSxTQUFTO0FBQUEsTUFDdkQ7QUFBQSxJQUNGLENBQUM7QUFBQSxJQUNELGNBQWM7QUFBQSxFQUNoQjtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ1AsT0FBTztBQUFBLE1BQ0wsS0FBSztBQUFBLElBQ1A7QUFBQSxFQUNGO0FBQUEsRUFDQSxRQUFRO0FBQUEsSUFDTixNQUFNO0FBQUEsSUFDTixNQUFNO0FBQUEsSUFDTixZQUFZO0FBQUEsSUFDWixLQUFLO0FBQUEsTUFDSCxNQUFNO0FBQUEsSUFDUjtBQUFBLEVBQ0Y7QUFBQSxFQUNBLE9BQU87QUFBQSxJQUNMLFFBQVE7QUFBQSxJQUNSLFdBQVc7QUFBQSxJQUNYLFFBQVE7QUFBQSxJQUNSLHVCQUF1QjtBQUFBLEVBQ3pCO0FBQ0YsQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
