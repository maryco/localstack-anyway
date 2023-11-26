// https://github.com/svg/svgo#configuration
declare module '*.svg?component' {
  import Svelte from 'svelte';
  export default Svelte.SvelteComponent;
}