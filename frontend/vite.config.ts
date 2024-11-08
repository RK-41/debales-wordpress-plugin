import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import cssInjectedByJsPlugin from 'vite-plugin-css-injected-by-js';
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react(), cssInjectedByJsPlugin({ topExecutionPriority: true })],
  build: {
    sourcemap: true,

    rollupOptions: {
      output: {
        dir: 'dist',
        entryFileNames: 'assets/[name].min.js',
        assetFileNames: 'assets/[name].min.[ext]',
      },
    },
    manifest: true,
  },
});
