type Exchanger = {
  html?: string,
  text?: string,
}

type SesMail = {
  html?: string,
  text?: string,
  subject?: string,
  date: string,
  to: Exchanger,
  from: Exchanger,
  messageId: string,
}

interface MailDeleted {
  id: string
}