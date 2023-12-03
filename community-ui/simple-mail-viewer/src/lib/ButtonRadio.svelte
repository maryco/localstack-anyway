<script lang="ts">
  export let id: string
  export let name: string
  export let option: InputOption<any, any>
  export let isChecked: boolean
  export let changeHandler: (e: { currentTarget: HTMLInputElement }) => void

  let ripple: HTMLElement

  const rippleEffect = [
    'opacity-10',
    'scale-100',
    'transition-transform',
    'duration-100',
  ]
  const clickHandler = () => {
    ripple.classList.add(...rippleEffect)
    setTimeout(() => {
      ripple.classList.remove(...rippleEffect)
    }, 100)
  }
</script>

<span
  class={`relative flex rounded border border-gray-border hover:opacity-100 hover:bg-gray-bg transition-colors select-none ${
    isChecked ? 'bg-gray-bg opacity-100' : 'opacity-70'
  }`}
>
  <input
    {id}
    {name}
    class="appearance-none"
    type="radio"
    value={option.value}
    on:change={changeHandler}
    on:click={clickHandler}
  />
  <span
    class="w-full h-full absolute top-0 left-0 rounded-full bg-gray-dark opacity-0 scale-0"
    aria-hidden="true"
    bind:this={ripple}
  ></span>
  <label for={id} class="relative px-4 py-1 text-xs text-theme cursor-pointer"
    >{option.label}</label
  >
</span>
