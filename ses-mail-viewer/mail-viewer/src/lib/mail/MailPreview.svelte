<script lang="ts">
  import { selectedMail } from '@/store'
</script>

<div class="max-w-[832px] py-6 px-8 grow flex flex-col bg-gray-bg">
  <div class="flex justify-between">
    <p>
      To<span class="mx-2">:</span><span>{$selectedMail?.to.text ?? ''}</span>
    </p>
    <span>{$selectedMail?.date ?? ''}</span>
  </div>
  <div class="mt-6 py-[68px] px-9 grow rounded-md border-gray-border bg-white">
    <h2 class="pb-3 border-b border-gray-border">
      {$selectedMail?.subject ?? ''}
    </h2>
    <div class="c-mail-body mt-8">{@html $selectedMail?.text ?? ''}</div>
  </div>
</div>

<style lang="scss">
  // See 'c-mail-body' in app.scss
</style>
