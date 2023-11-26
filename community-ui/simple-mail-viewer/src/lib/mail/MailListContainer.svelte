<script lang="ts">
  import { fly, fade } from 'svelte/transition'
  import { cubicOut } from 'svelte/easing'
  import DeleteIcon from '@/assets/icons/tornado-line.svg?component'
  import ReloadIcon from '@/assets/icons/loop-right-line.svg?component'
  import ReceiveSvg from '@/assets/receive.svg?component'
  import MailListCard from '@/lib/mail/MailListCard.svelte'
  import HeaderButton from '@/lib/HeaderButton.svelte'
  import { selectedMail } from '@/store'
  import { clearSes, fetchSes } from '@/api'

  export let mails: SesMail[]

  const updateList = (e: CustomEvent) => {
    mails = mails.filter((mail) => mail.messageId !== e.detail.id)
  }

  const refresh = async () => {
    mails = await fetchSes()
  }

  const destloy = async () => {
    await clearSes()
    mails = await fetchSes()
  }
</script>

<section
  class="min-w-[380px] max-w-[380px] max-h-screen flex flex-col flex-nowrap justify-start bg-white"
>
  <div
    class="w-full h-9 pl-6 pr-3 sticky top-0 flex gap-1 shrink-0 justify-end bg-theme z-10"
  >
    <HeaderButton clickHandler={refresh}><ReloadIcon /></HeaderButton>
    <HeaderButton clickHandler={destloy}><DeleteIcon /></HeaderButton>
  </div>
  <ul class="max-h-screen overflow-y-scroll">
    {#each mails as mail (mail.messageId)}
      <li
        out:fly={{ delay: 150, duration: 400, x: -380, easing: cubicOut }}
        in:fly={{ delay: 150, duration: 400, x: -380 }}
      >
        <div
          class="c-mail-card focus:outline-none"
          tabindex="0"
          role="button"
          on:click={() => selectedMail.set(mail)}
          on:keyup={(e) => {
            if (e.code?.toLowerCase() === 'enter') selectedMail.set(mail)
          }}
        >
          <MailListCard {mail} on:deleted={updateList} />
        </div>
      </li>
    {:else}
      <li
        class="grid place-items-center h-36 mt-24"
        in:fade={{ delay: 600, duration: 300 }}
      >
        <ReceiveSvg class="fill-[#f7f7f7] h-full w-auto" />
      </li>
    {/each}
  </ul>
</section>
