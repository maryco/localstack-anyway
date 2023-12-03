<script lang="ts">
  export let clickHandler: () => void

  let ripple: HTMLElement
  let buttonElement: HTMLButtonElement

  const rippleEffect = ['opacity-30', 'scale-0', 'transition-transform', 'duration-500'];
  const clickHandlerWrapper = () => {
    buttonElement.blur()
    ripple.classList.add(...rippleEffect)
    setTimeout(() => {
      ripple.classList.remove(...rippleEffect)
      clickHandler()
    }, 500)
  }
</script>

<div class="relative">
  <button
    class="c-header-button w-9 h-full flex justify-center items-center rounded-full focus-no-outline hover:bg-gray-bg transition-color duration-300"
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
