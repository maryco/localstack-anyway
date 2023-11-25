import { writable } from 'svelte/store'

export const selectedMail = writable<SesMail | null>()
