<script lang="ts">
  export let name: string
  export let theme: 'normal' | 'notice' = 'normal'
  export let clickHandler: () => void

  const focusFillClass = theme === 'normal' ? '__normal' : '__notice'

  let buttonElement: HTMLButtonElement

  const clickHandlerWrapper = () => {
    buttonElement.blur()
    clickHandler()
  }
</script>

<button
  {name}
  class={`h-[20px] w-[20px] rounded-full ring-inset focus-no-outline transition-all fill-gray-light hover:scale-125 focus:scale-110 ${focusFillClass}`}
  on:click|stopPropagation={clickHandlerWrapper}
  bind:this={buttonElement}
>
  <slot />
</button>

<style lang="scss">
  .__normal {
    &:hover,
    &:focus {
      fill: rgb(var(--color-theme));
    }
  }
  .__notice {
    &:hover,
    &:focus {
      fill: rgb(var(--color-notice));
    }
  }
</style>
