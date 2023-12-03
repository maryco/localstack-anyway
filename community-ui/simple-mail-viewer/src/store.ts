import { writable } from 'svelte/store'

export const selectedMail = writable<SesMail | null>()

export const previewModeStore = writable<PreviewMode>('html')

export const previewWidthStore = writable<ScreenWidth>('none')
