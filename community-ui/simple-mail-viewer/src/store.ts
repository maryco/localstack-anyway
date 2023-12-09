import { writable } from 'svelte/store'

import type { PreviewMode, ScreenWidth } from '@/types/Constant'
import type { SesMail } from '@/types/SesMail'

export const selectedMail = writable<SesMail | null>()

export const previewModeStore = writable<PreviewMode>('html')

export const previewWidthStore = writable<ScreenWidth>('none')
