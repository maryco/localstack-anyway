<script lang="ts">
  import { fade, slide } from 'svelte/transition'

  import CopyIcon from '@/assets/icons/file-copy-line.svg?component'
  import FullScreenIcon from '@/assets/icons/fullscreen-line.svg?component'
  import SmartphoneIcon from '@/assets/icons/smartphone-line.svg?component'
  import TabletIcon from '@/assets/icons/tablet-line.svg?component'
  import ButtonRadio from '@/lib/ButtonRadio.svelte'
  import IconButton from '@/lib/IconButton.svelte'
  import IconRadio from '@/lib/IconRadio.svelte'
  import { selectedMail, previewModeStore, previewWidthStore } from '@/store'
  import {
    previewModeOptions,
    previewWidthOptions,
    previewWidth,
    type ScreenWidth,
    type PreviewMode,
  } from '@/types/Constant'

  // FIXME
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  const previewSizeIcons: { [key in ScreenWidth]: any } = {
    none: FullScreenIcon,
    sm: TabletIcon,
    xs: SmartphoneIcon,
  }

  const changePreviewMode = (e: { currentTarget: HTMLInputElement }) => {
    previewModeStore.set(e.currentTarget.value as PreviewMode)
  }

  const changePreviewWidth = (e: { currentTarget: HTMLInputElement }) => {
    previewWidthStore.set(e.currentTarget.value as ScreenWidth)
  }

  let mailBodyContainer: HTMLDivElement
  let mailBodyContainerWidth: number

  const copyToClipboard = () => {
    const text =
      $previewModeStore === 'html'
        ? $selectedMail?.html
        : mailBodyContainer?.innerText
    if (!text) {
      return
    }
    navigator.clipboard.writeText(text).then(
      () => {
        mailBodyContainer.classList.add('animate-pulse-once')
        setTimeout(
          () => mailBodyContainer.classList.remove('animate-pulse-once'),
          300,
        )
      },
      () => {
        alert('Fails to copy to clipboard!')
      },
    )
  }
</script>

<div
  class="min-w-full max-h-screen overflow-y-scroll py-6 px-8 grow flex flex-col bg-gray-bg"
>
  <div class="flex justify-between">
    <p>
      To<span class="mx-2">:</span><span>{$selectedMail?.to.text ?? ''}</span>
    </p>
    <span>{$selectedMail?.date ?? ''}</span>
  </div>
  <div
    class="mt-4 pt-4 pb-[68px] px-9 grow rounded-md border-gray-border bg-white flex flex-col"
  >
    <div class="grow-0 flex justify-end gap-1 items-center">
      {#if $previewModeStore === 'html'}
        <div class="mr-4 flex gap-2" in:slide={{ axis: 'y' }}>
          {#each previewWidthOptions as option}
            <IconRadio
              id={`screen-width-${option.value}`}
              name="screen-width"
              isChecked={option.value === $previewWidthStore}
              {option}
              changeHandler={changePreviewWidth}
            >
              <svelte:component this={previewSizeIcons[option.value]} />
            </IconRadio>
          {/each}
        </div>
      {/if}
      {#each previewModeOptions as option}
        <ButtonRadio
          id={`preview-mode-${option.value}`}
          name="preview-mode"
          isChecked={option.value === $previewModeStore}
          {option}
          changeHandler={changePreviewMode}
        />
      {/each}
      <IconButton name="Copy to clipboard" clickHandler={copyToClipboard}
        ><CopyIcon /></IconButton
      >
    </div>
    <h2 class="mt-8 pb-3 border-b border-gray-border">
      <span class="min-h-4 inline-block">{$selectedMail?.subject ?? ''}</span>
    </h2>
    <div
      class="c-mail-body pt-8 grow"
      bind:this={mailBodyContainer}
      bind:clientWidth={mailBodyContainerWidth}
    >
      {#if $previewModeStore === 'html'}
        <div
          class="h-full mx-auto transition-[width] duration-300 rounded border border-gray-border shadow-sm"
          style:width={`${Math.min(
            previewWidth[$previewWidthStore],
            mailBodyContainerWidth,
          )}px`}
        >
          <iframe
            title="HTML Mail Preview"
            srcdoc={$selectedMail?.html ?? ''}
            class="w-full h-full"
            in:fade
          />
        </div>
      {:else if $previewModeStore === 'text'}
        <span class="break-all whitespace-pre-wrap" in:fade
          >{$selectedMail?.text ?? ''}</span
        >
      {:else if $previewModeStore === 'source'}
        <span class="break-all whitespace-pre-wrap" in:fade
          >{$selectedMail?.html ?? ''}</span
        >
      {/if}
    </div>
  </div>
</div>

<style lang="scss">
  .c-mail-body {
    & :global(a) {
      text-decoration: underline;
      color: rgb(var(--color-link));
    }
  }
</style>
