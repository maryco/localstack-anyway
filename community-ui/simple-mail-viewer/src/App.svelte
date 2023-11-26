<script lang="ts">
  import MailListContainer from '@/lib/mail/MailListContainer.svelte'
  import MailPreviewContainer from '@/lib/mail/MailPreviewContainer.svelte'
  import { fetchSes } from '@/api'
</script>

<main class="w-screen min-h-screen flex">
  {#await fetchSes()}
    TODO
  {:then mails} 
    <MailListContainer {mails} />
  {/await}
  <MailPreviewContainer />
</main>
