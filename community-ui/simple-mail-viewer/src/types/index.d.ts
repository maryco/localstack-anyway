// https://github.com/svg/svgo#configuration
declare module '*.svg?component' {
  import Svelte from 'svelte';
  export default Svelte.SvelteComponent;
}

type InputOption<T, U> = {
  label: T,
  value: U
}

type PreviewMode = 'html' | 'text' | 'source'

type ScreenWidth = 'none' | 'sm' | 'xs'
