<script lang="ts">
  import { fetchSes } from '@/api'
  import MailListContainer from '@/lib/mail/MailListContainer.svelte'
  import MailPreviewContainer from '@/lib/mail/MailPreviewContainer.svelte'
</script>

<main class="w-screen min-h-screen max-h-screen flex">
  {#await fetchSes()}
    <div class="w-screen h-screen bg-white"></div>
  {:then mails}
    <MailListContainer {mails} />
    <MailPreviewContainer />
  {/await}
</main>
