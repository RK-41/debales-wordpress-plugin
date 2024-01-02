import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    sourcemap: true,
    rollupOptions: {
      output: {
        dir: "dist",
        entryFileNames: "assets/[name].min.js",
        assetFileNames: "assets/[name].min.[ext]",
      }
    },
    manifest: true,
  },
  plugins: [react()],
});
