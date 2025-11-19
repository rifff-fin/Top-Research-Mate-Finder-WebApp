import { useEffect, useState } from 'react';

function ChatWindow({ userId, otherId }) {
  const [messages, setMessages] = useState([
    { sender: otherId, content: "Hello!" },
    { sender: userId, content: "Hi there!" }
  ]);
  const [newMessage, setNewMessage] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!newMessage.trim()) return;
    setMessages(prev => [...prev, { content: newMessage, sender: userId }]);
    setNewMessage('');
  };

  return (
    <div style={{ border: '1px solid #ddd', padding: '10px', maxWidth: '400px' }}>
      <div style={{ height: '300px', overflowY: 'auto', border: '1px solid #ccc', padding: '5px', marginBottom: '10px' }}>
        {messages.map((msg, idx) => (
          <p key={idx} style={{ textAlign: msg.sender === userId ? 'right' : 'left' }}>
            {msg.content}
          </p>
        ))}
      </div>
      <form onSubmit={handleSubmit} style={{ display: 'flex' }}>
        <input
          value={newMessage}
          onChange={(e) => setNewMessage(e.target.value)}
          style={{ flex: 1, marginRight: '5px' }}
        />
        <button type="submit">Send</button>
      </form>
    </div>
  );
}

export default ChatWindow;
