export const fetchSes = async () => {
  const res = await fetch("http://localhost:3003/api/ses");
  return await res.json().then((res) => {
    return [...res.messages.reverse()]
  });
}

export const clearSes = async () => {
  await fetch("http://localhost:3003/api/ses", {method: 'DELETE'});
}
