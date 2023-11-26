/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./src/index.html",
    "./src/**/*.{js,ts,svelte}",
  ],
  theme: {
    colors: {
      white: '#ffffff',
      black: 'rgb(var(--color-black) / 1)', // #18181b = zinc-900
      theme: 'rgb(var(--color-theme) / 1)', // #485b7f
      gray: {
        light: 'rgb(var(--color-gray-light) / 1)', // #dcdcdc
        border: 'rgb(var(--color-gray-border) / 1)', // #ececec
        bg: 'rgb(var(--color-gray-bg) / 1)', // #f7f7f7
      },
      notice: 'rgb(var(--color-notice) / 1)', // #ff9090
      link: 'rgb(var(--color-link) / 1)', // #1d4ed8
    },
    extend: {
      // https://www.mailslurp.com/blog/tailwind-print-styles-custom-media-query/
      screens: {
        'print': { 'raw': 'print' },
      },
    },
  },
  plugins: [],
}
