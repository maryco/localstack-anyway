const fs = require('node:fs/promises')
const express = require('express')
const cors = require('cors');
const http = require('node:http')
const fetch = require('node-fetch').default
const simpleParser = require('mailparser').simpleParser

const port = process.env.PORT || 3003;

const app = express()
app.use(cors())
app.use('/public', express.static('./localstack-proxy/mail-viewer'));

// SES Viewer
app.get('/', async (req, res) => {
  const html = await fs.readFile('./localstack-proxy/mail-viewer/index.html', 'utf-8')
  res.status(200).set({ 'Content-Type': 'text/html' }).end(html)
})

// Get SES receptions
app.get('/api/ses', async (req, res) => {
  try {
    // https://www.npmjs.com/package/node-fetch#custom-highwatermark
    const localstackRes = await fetch('http://localhost:4566/_aws/ses')
    const r1 = localstackRes.clone();
    const [data, text] = await Promise.all([localstackRes.json(), r1.text()]);

    if (!localstackRes.ok) {
      throw new Error(text)
    }

    if (data.messages.length === 0) {
      res.json({ messages: [] })
    } else {
      const parsed = await Promise.all(
        [...data.messages.map((msg) => simpleParser(msg?.RawData))]
      )
      res.json({ messages: parsed })
    }
  } catch (e) {
    console.error(e.message)
    res.status(500).end(e.message)
  }
})

// Delete ALL SES receptions
app.delete('/api/ses', async (req, res) => {
  // TODO: ?id=xxxxxx
  try {
    const localstackRes = await fetch('http://localhost:4566/_localstack/ses', { method: 'DELETE' })
    if (!localstackRes.ok) {
      const error = await response.text()
      throw new Error(error)
    } else {
      res.status(204).end()
    }
  } catch (e) {
    console.error(e.message)
    res.status(500).end(e.message)
  }
})

app.listen(port, () => {
  console.log(`Express is up at port http://localhost:${port}`);
});
