type Exchanger = {
  html?: string,
  text?: string,
}

export type SesMail = {
  messageId: string,
  date: string,
  to: Exchanger,
  from: Exchanger,
  subject?: string,
  html?: string,
  text?: string,
}

export interface MailRemoved {
  id: string
}