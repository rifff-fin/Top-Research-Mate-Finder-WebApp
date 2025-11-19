import ChatWindow from '../components/ChatWindow';

function Chats() {
  // Assume list of chat partners
  return (
    <div className="container">
      <h1>Chats</h1>
      {/* List chat partners, on click show ChatWindow */}
      <ChatWindow userId={1} otherId={2} /> {/* Example */}
    </div>
  );
}

export default Chats;