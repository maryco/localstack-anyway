import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'
import svelteSVG from 'vite-plugin-svelte-svg'

const isProduction = process.env.NODE_ENV === 'production'
const port = process.env.PORT || 3003;

// https://vitejs.dev/config/
export default defineConfig({
  base: isProduction ? `http://localhost:${port}/public` : './',
  build: {
    outDir: isProduction ? '../localstack-proxy/mail-viewer' : 'dist',
  },
  resolve: {
    alias: [{find: '@', replacement: '/src'}]
  },
  plugins: [
    svelte(),
    svelteSVG({
      svgoConfig: {}, // See https://github.com/svg/svgo#configuration
      requireSuffix: true, // Set false to accept '.svg' without the '?component'
    }),
  ],
})
