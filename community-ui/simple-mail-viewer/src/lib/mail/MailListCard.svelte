<script lang="ts">
  import { createEventDispatcher } from 'svelte'

  import CloseIcon from '@/assets/icons/close-circle-line.svg?component'
  import EyeIcon from '@/assets/icons/eye-line.svg?component'
  import IconButton from '@/lib/IconButton.svelte'
  import { selectedMail } from '@/store'

  import type { MailRemoved, SesMail } from '@/types/SesMail'

  export let mail: SesMail

  const dispatch = createEventDispatcher<{ removed: MailRemoved }>()

  let isSelected: boolean
  $: isSelected = $selectedMail?.messageId === mail.messageId

  const removeMail = () => {
    if (!mail) {
      return
    }
    if ($selectedMail?.messageId === mail.messageId) {
      selectedMail.set(null)
    }
    dispatch('removed', { id: mail.messageId })
  }
</script>

<div
  class="c-mail-card h-[110px] p-5 flex flex-col justify-center cursor-pointer text-sm transition-color duration-200"
>
  <p class="leading-5 line-clamp-2">
    {mail?.subject}
  </p>
  <div class="mt-2 flex justify-between">
    <span class="opacity-60">{mail?.date}</span>
    <div class="flex gap-2">
      <div
        class="flex items-center fill-gray-light transition-colors"
        class:fill-theme={isSelected}
      >
        <EyeIcon class="h-[20px] w-[20px]" />
      </div>
      <div class="flex items-center hover:z-50">
        <IconButton
          name="Remove from list"
          theme="notice"
          clickHandler={removeMail}
          --focus-color="rgb(var(--color-notice))"><CloseIcon /></IconButton
        >
      </div>
    </div>
  </div>
</div>

<style lang="scss">
  :global(.c-mail-card) {
    &:hover,
    &:active,
    &:focus {
      background-color: rgb(var(--color-gray-bg));
      box-shadow: inset 0px 0px 6px 2px rgba(226, 226, 226, 0.25);
    }
  }
</style>
