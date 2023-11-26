<script lang="ts">
  export let clickHandler: () => void
</script>

<button
  class="c-iconBtn h-[20px] w-[20px] ring-inset focus:outline-none focus:ring"
  on:click|stopPropagation={clickHandler}
>
  <slot />
</button>

<style lang="scss">
  .c-iconBtn {
    fill: rgb(var(--color-gray-light));
    &:hover,
    &:focus {
      fill: rgb(var(--color-notice));
    }
  }
</style>
