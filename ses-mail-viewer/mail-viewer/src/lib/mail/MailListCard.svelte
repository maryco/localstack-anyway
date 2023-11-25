<script lang="ts">
  import CloseIcon from '@/assets/icons/close-circle-line.svg?component'
  import IconButton from '@/lib/IconButton.svelte'
  import { selectedMail } from '@/store'
  import { createEventDispatcher } from 'svelte'

  export let mail: SesMail

  const dispatch = createEventDispatcher<{ deleted: MailDeleted }>()

  const deleteMail = () => {
    if (!mail) {
      return
    }
    if ($selectedMail?.messageId === mail.messageId) {
      selectedMail.set(null)
    }
    dispatch('deleted', { id: mail.messageId })
  }
</script>

<div
  class="c-mail-card h-[110px] p-5 cursor-pointer text-sm transition-color duration-200"
>
  <p class="leading-5 line-clamp-2">
    {mail?.subject}
  </p>
  <div class="mt-2 flex justify-between">
    <span class="opacity-60">{mail?.date}</span>
    <div class="flex items-center">
      <IconButton clickHandler={deleteMail}><CloseIcon /></IconButton>
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
