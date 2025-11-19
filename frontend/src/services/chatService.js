import api from "@/services/api";

// Fetch chats for logged-in user
export const getChats = async () => {
  try {
    const response = await api.get("api.php", {
      params: { action: "getChats" },
    });
    return response.data;
  } catch (error) {
    console.error("Get chats error:", error);
    return null;
  }
};

// Send a new chat message
export const sendMessage = async (receiverId, message) => {
  try {
    const response = await api.post("api.php", {
      action: "sendMessage",
      receiver_id: receiverId,
      message,
    });
    return response.data;
  } catch (error) {
    console.error("Send message error:", error);
    return null;
  }
};
