const toggle = document.getElementById('chatToggle');
const panel = document.getElementById('chatPanel');
const closeBtn = document.getElementById('chatClose');
const form = document.getElementById('chatForm');
const input = document.getElementById('chatInput');
const messages = document.getElementById('chatMessages');
function addMessage(role, text) { const div = document.createElement('div'); div.className = 'msg ' + role; div.textContent = text; messages.appendChild(div); messages.scrollTop = messages.scrollHeight; }
if (toggle) toggle.addEventListener('click', () => { panel.hidden = false; toggle.hidden = true; if (!messages.children.length) addMessage('assistant', 'Hello, I can help with AI-Solutions services, demos, events, and enquiries. What would you like to know?'); });
if (closeBtn) closeBtn.addEventListener('click', () => { panel.hidden = true; toggle.hidden = false; });
if (form) form.addEventListener('submit', async (event) => { event.preventDefault(); const text = input.value.trim(); if (!text) return; addMessage('user', text); input.value = ''; addMessage('assistant', 'Thinking...'); const waiting = messages.lastChild; try { const res = await fetch('api/chat.php', { method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify({message: text}) }); const data = await res.json(); waiting.textContent = data.reply || 'I could not answer that.'; } catch (error) { waiting.textContent = 'The chat service is not available right now.'; } });
