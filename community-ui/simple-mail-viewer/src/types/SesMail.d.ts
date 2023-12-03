type Exchanger = {
  html?: string,
  text?: string,
}

type SesMail = {
  messageId: string,
  date: string,
  to: Exchanger,
  from: Exchanger,
  subject?: string,
  html?: string,
  text?: string,
}

interface MailRemoved {
  id: string
}