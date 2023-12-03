<script lang="ts">
  export let id: string
  export let name: string
  export let option: InputOption<any, any>
  export let isChecked: boolean
  export let changeHandler: (e: { currentTarget: HTMLInputElement }) => void
</script>

<span
  class={`relative h-[20px] w-[20px] rounded-full transition-all hover:fill-theme hover:scale-125 focus:scale-110 ${
    isChecked ? 'fill-theme' : 'fill-gray-light opacity-70'
  }`}
>
  <input
    {id}
    {name}
    class="appearance-none"
    type="radio"
    value={option.value}
    on:change={changeHandler}
  />
  <label for={id} title={option.label} class="absolute top-0 left-0 w-full h-full cursor-pointer"
  ><slot /></label>
</span>
