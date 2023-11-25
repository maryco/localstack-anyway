<script lang="ts">
  export let clickHandler: () => void

  let ripple: HTMLElement
  let buttonElement: HTMLButtonElement

  const clickHandlerWrapper = () => {
    buttonElement.blur()
    ripple.classList.add('opacity-50', 'scale-0', 'transition-transform')
    setTimeout(() => {
      ripple.classList.remove('opacity-50', 'scale-0', 'transition-transform')
      clickHandler()
    }, 300)
  }
</script>

<div class="relative">
  <button
    class="c-header-button w-9 h-full flex justify-center items-center rounded-full hover:bg-gray-bg transition-color duration-300 focus:outline-none focus:ring"
    on:click={clickHandlerWrapper}
    bind:this={buttonElement}
  >
    <span
      bind:this={ripple}
      class="w-9 h-full rounded-full absolute top-0 left-0 border-4 border-link opacity-0 scale-1"
    ></span>
    <slot />
  </button>
</div>

<style lang="scss">
  .c-header-button {
    & > :global(svg) {
      width: 20px;
      height: 20px;
      fill: rgb(var(--color-white));
    }

    &:hover > :global(svg) {
      fill: rgb(var(--color-black));
    }
  }
</style>
