async function apiFetch(url, options = {}) {
    const res = await fetch(url, options);
    return res.json();
}
